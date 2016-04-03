<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Document;

class DocumentsController extends Controller
{


    /**
     * @param Document $document
     * @return array
     */
    public function show(Document $document)
    {
        return view('documents.show')->withDocument($document);

    }


}
