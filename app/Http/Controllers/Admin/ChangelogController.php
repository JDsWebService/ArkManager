<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\FormHandler;
use App\Handlers\ChangelogHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Logs\Changelog;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ChangelogHandlerException;

class ChangelogController extends Controller
{
    /**
     * Returns the add new changelog entry view to the admin
     *
     * @return mixed
     */
    public function add() {
        $categories = ChangelogHandler::getCategories();
        return view('admin.changelog.add')
                ->withCategories($categories);
    }

    /**
     * Stores the changelog entry from the request to the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $request = FormHandler::clean($request);
        $validator = ChangelogHandler::validateChangelogRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('admin.changelog.add')
                ->withErrors($validator)
                ->withInput($request->all());
        }

        try {
            ChangelogHandler::saveEntryToDatabase($request);
        } catch(ChangelogHandlerException $e) {
            return redirect()
                    ->route('admin.changelog.add')
                    ->withErrors(['message' => $e->getMessage()])
                    ->withInput($request->all());
        }

        Session::flash('success', 'Added the changelog entry successfully!');
        return redirect()->route('admin.changelog.index');
    }

    /**
     * Returns the index of all the change logs
     *
     * @return mixed
     */
    public function index() {
        $logs = Changelog::orderBy('id', 'desc')->paginate(5);
        return view('admin.changelog.index')
                ->withLogs($logs);
    }

    /**
     * Deletes the log specified from the changelog
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $log = Changelog::find($id);
        $version = $log->full_version_string;
        $log->delete();
        Session::flash('success', "Change log entry for {$version} has been deleted");
        return redirect()->route('admin.changelog.index');
    }

    /**
     * Returns the edit changelog view to the user
     *
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        $log = Changelog::find($id);
        $categories = ChangelogHandler::getCategories();
        return view('admin.changelog.edit')
                ->withLog($log)
                ->withCategories($categories);
    }

    /**
     * Updates a log entry in the database
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $request = FormHandler::clean($request);
        $validator = ChangelogHandler::validateChangelogRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('admin.changelog.edit', $id)
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $log = Changelog::find($id);
        try {
            ChangelogHandler::updateEntryInDatabase($request, $log);
        } catch(ChangelogHandlerException $e) {
            return redirect()
                    ->route('admin.changelog.edit', $id)
                    ->withErrors(['message' => $e->getMessage()]);
        }
        Session::flash('success', "You have successfully edited log entry with the ID of {$log->id}");
        return redirect()->route('admin.changelog.index');
    }
}
