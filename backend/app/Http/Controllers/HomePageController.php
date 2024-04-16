<?php

namespace App\Http\Controllers;

use App\Actions\Eloquent\CreateActionInterface;
use App\Actions\Eloquent\GetActionInterface;
use App\Http\Requests\File\CreateRequest;
use App\Http\Requests\File\FilterFiles;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


/**
 *
 */
class HomePageController extends Controller
{
    /**
     * @param GetActionInterface $getAction
     * @param File $file
     * @param FilterFiles $request
     * @return View
     */
    public function index(GetActionInterface $getAction, File $file, FilterFiles $request): View
    {
        $filesAndFolders = FileResource::collection($getAction->handle($file, filters: [['parent_id', $request->validated('parent_id')]],relations: ['children', 'parent']));

        $folders = FileResource::collection($getAction->handle($file, filters: [['type', 'folder']]));

        return view('home', ['files' => $filesAndFolders, 'foldersForForm' => $folders]);
    }

    /**
     * @param File $file
     * @param CreateActionInterface $createAction
     * @param CreateRequest $request
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function createFile(File $file, CreateActionInterface $createAction, CreateRequest $request)
    {
        $createAction->handle($file, $request->validated());

        Session::flash('status', 'File successfully created!');

        return redirect(route('home'));
    }

}
