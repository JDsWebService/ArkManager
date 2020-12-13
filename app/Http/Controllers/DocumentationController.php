<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Documentation\Documentation;

class DocumentationController extends Controller
{

    /**
     * Shows the documentation index page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index() {
        $docs = Documentation::orderBy('created_at')->get()->groupBy('category');
        if($docs == null) {
            Session::flash('info', "We haven't created any documentation just yet. Come back soon to find out more about ArkManager.app!");
            return redirect()->route('index');
        }
        $popularDocs = Documentation::orderBy('liked')->get()->take(5);
        $newestDocs = Documentation::orderBy('created_at')->get()->take(5);
        return view('documentation.index')
                ->withDocs($docs)
                ->withPopularDocs($popularDocs)
                ->withNewestDocs($newestDocs);
    }

    /**
     * Views a single documentation article
     *
     * @param $category
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function viewSingle($category, $slug) {
        $doc = Documentation::where('slug', $slug)->first();
        if($doc == null) {
            Session::flash('warning', 'This documentation does not exist.');
            return redirect()->route('documentation.index');
        }
        return view('documentation.view.single')
                ->withDoc($doc);
    }

    /**
     * Shows the documentation associated with the selected category
     *
     * @param $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function viewCategory($category) {
        $docs = Documentation::where('category', Str::lower($category))->paginate(10);
        if($docs == null) {
            Session::flash('warning', "No documentation found for {$category}. Try again later.");
            return redirect()->route('documentation.index');
        }
        return view('documentation.view.category')
                ->withDocs($docs)
                ->withCategory($category);
    }
}
