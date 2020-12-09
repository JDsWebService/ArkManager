<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\FormHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Handlers\DocumentationHandler;
use Illuminate\Support\Facades\Session;
use App\Models\Documentation\Documentation;
use League\CommonMark\Block\Element\Document;
use Illuminate\Validation\ValidationException;
use App\Exceptions\DocumentationHandlerException;

class DocumentationController extends Controller
{
    /**
     * Returns the add documentation view to the admin user
     *
     * @return mixed
     */
    public function add() {
        $categories = DocumentationHandler::getCategories();
        return view('admin.documentation.add')
                ->withCategories($categories);
    }

    /**
     * Stores the documentation request into the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $request = FormHandler::clean($request);
        $validator = DocumentationHandler::validateDocumentationRequest($request);
        if($validator->fails() == true) {
            return redirect()
                ->route('admin.documentation.add')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            DocumentationHandler::storeNewDocumentation($request);
        } catch (DocumentationHandlerException $e) {
            return redirect()
                    ->route('admin.documentation.add')
                    ->withErrors(['message' => $e->getMessage()])
                    ->withInput($request->all());
        }

        Session::flash('success', "Stored the documentation successfully!");
        return redirect()->route('admin.documentation.index');
    }

    /**
     * Returns the index view of the admin documentation backend
     *
     * @return mixed
     */
    public function index() {
        $docs = Documentation::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index')
                ->withDocs($docs);
    }

    /**
     * Returns the edit documentation view to the admin user
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($slug) {
        $documentation = Documentation::where('slug', $slug)->first();
        $categories = DocumentationHandler::getCategories();
        if(!$documentation) {
            Session::flash('warning', 'This documentation does nto exist');
            return redirect()->route('admin.documentation.index');
        }
        return view('admin.documentation.edit')
                ->withDocumentation($documentation)
                ->withCategories($categories);
    }

    /**
     * Updates the documentation in the database
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $slug) {
        $request = FormHandler::clean($request);
        $validator = DocumentationHandler::validateDocumentationRequest($request);
        if($validator->fails() == true) {
            return redirect()
                ->route('admin.documentation.edit', $slug)
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            DocumentationHandler::updateDocumentation($request, $slug);
        } catch (DocumentationHandlerException $e) {
            return redirect()
                ->route('admin.documentation.edit', $slug)
                ->withErrors(['message' => $e->getMessage()])
                ->withInput($request->all());
        }

        Session::flash('success', "Updated the documentation successfully!");
        return redirect()->route('admin.documentation.index');
    }

    /**
     * Deletes the documentation from the database
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($slug) {
        $doc = Documentation::where('slug', $slug)->first();
        if(!$doc) {
            Session::flash('warning', 'This documentation does not exist in the database!');
            return redirect()->route('admin.documentation.index');
        }
        $doc->delete();
        Session::flash('success', 'You have deleted the documentation successfully!');
        return redirect()->route('admin.documentation.index');
    }
}
