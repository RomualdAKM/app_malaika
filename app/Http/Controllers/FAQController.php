<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFAQRequest;
use App\Http\Requests\UpdateFAQRequest;
use RealRashid\SweetAlert\Facades\Alert;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        $faqs = $structure->faqs()->get();
        return view('app.faq.index', [
            'faqs' => $faqs,
            'my_actions' => $this->faq_actions(),
            'my_attributes' => $this->faq_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.faq.create', [
            'my_fields' => $this->faq_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFAQRequest $request)
    {
        $faq = new FAQ();

        $faq->structure_id = Auth::user()->structure_id;
        $faq->title = $request->title;
        $faq->content = $request->content;

        if ($faq->save()) {
            Alert::toast("Données enregistrées", 'success');
            return redirect('faq');
        } else {
            Alert::toast('Une erreur est survenue', 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $faq)
    {
        return view('app.faq.show', [
            'faq' => $faq,
            'my_fields' => $this->faq_fields(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('app.faq.edit', [
            'faq' => $faq,
            'my_fields' => $this->faq_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFAQRequest $request, FAQ $faq)
    {
        $faq->title = $request->title;
        $faq->content = $request->content;
       
        if ($faq->save()) {
            Alert::toast('Les informations ont été modifiées', 'success');
            return redirect('faq');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        try {
            $faq = $faq->delete();
            Alert::success('Opération effectuée', 'Suppression éffectué');
            return redirect('faq');
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Element introuvable');
            return redirect()->back();
        }
    }

    private function faq_columns()
    {
        $columns = (object) array(
            'title' => 'Titre',
            'content' => 'Contenu',
        );
        return $columns;
    }

    private function faq_actions()
    {
        $actions = (object) array(
            'show' => 'Voir',
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function faq_fields()
    {
        $fields = [
            'title' => [
                'title' => 'Titre',
                'field' => 'text'
            ],
            'content' => [
                'title' => 'Contenu',
                'field' => 'richtext',
                'colspan' => true
            ],
        ];

        return $fields;
    }
}
