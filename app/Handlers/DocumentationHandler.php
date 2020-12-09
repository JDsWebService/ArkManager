<?php

namespace App\Handlers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Documentation\Documentation;
use App\Exceptions\DocumentationHandlerException;

class DocumentationHandler
{
    /**
     * Returns all the available documentation categories
     *
     * @return string[]
     */
    public static function getCategories() {
        return [
            'breeding' => 'Dino Breeding',
            'tribe' => 'Tribe Management',
            'trade' => 'Trade Hub',
            'api' => 'ArkManager API',
        ];
    }

    /**
     * Stores a new documentation request into the database
     *
     * @param Request $request
     * @throws DocumentationHandlerException
     */
    public static function storeNewDocumentation(Request $request)
    {
        $documentation = new Documentation;
        $documentation = self::handleDocumentationRequestFields($request, $documentation);
        if(!$documentation->save()) {
            throw new DocumentationHandlerException("Failed to save the documentation");
        }
    }

    /**
     * Validates the documentation request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validateDocumentationRequest(Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getDocumentationValidationRules());
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator;
    }

    /**
     * Returns the Documentation validation rules array
     *
     * @return string[]
     */
    private static function getDocumentationValidationRules()
    {
        return [
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'body' => 'required|string|max:65535',
        ];
    }

    /**
     * Returns the Documentation validation attribute names
     *
     * @return string[]
     */
    private static function getValidationAttributeNames()
    {
        return [
            'title' => 'Documentation Title',
            'category' => 'Documentation Category',
            'body' => 'Documentation Content',
        ];
    }

    /**
     * Handles all the request fields and assigns them
     * to the documentation instance
     *
     * @param Request $request
     * @param Documentation $documentation
     * @return Documentation
     */
    private static function handleDocumentationRequestFields(Request $request, Documentation $documentation)
    {
        $documentation->user_id = Auth::user()->id;
        $documentation->category = $request->category;
        $documentation->title = $request->title;
        if($documentation->slug == null) {
            $documentation->slug = self::generateNewSlug($request);
        }
        $documentation->body = $request->body;
        return $documentation;
    }

    /**
     * Generates a new slug for documentation
     *
     * @param Request $request
     * @return string
     */
    private static function generateNewSlug(Request $request)
    {
        return Str::slug($request->title) . '-' . Auth::user()->id . '-' . Carbon::now()->timestamp;
    }

    /**
     * Updates the documentation in the database
     *
     * @param Request $request
     * @param $slug
     * @throws DocumentationHandlerException
     */
    public static function updateDocumentation(Request $request, $slug)
    {
        $documentation = Documentation::where('slug', $slug)->first();
        if(!$documentation) {
            throw new DocumentationHandlerException("Documentation does not exist.");
        }
        $documentation = self::handleDocumentationRequestFields($request, $documentation);
        if(!$documentation->save()) {
            throw new DocumentationHandlerException("Failed to save the documentation");
        }
    }


}
