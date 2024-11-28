<?php

namespace App\Http\Controllers;

use App\Models\Attribute as ModelsAttribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    function index()
    {
        $data = ['attr' => ModelsAttribute::all()];
        return view('attribute/index', $data);
    }

    function addAttribute(Request $req)
    {
        if ($req->isMethod('post')) {
            $data = $req->validate(['name' => 'required|max:64']);
            $ret = ModelsAttribute::create($data);

            if ($ret) {
                return redirect('/manage/attribute');
            }
        }

        return view('attribute.add');
    }

    function editAttribute(Request $req, int $id)
    {
        $o = ModelsAttribute::find($id);
        if ($req->isMethod('post')) {
            $data = $req->validate(['name' => 'required']);

            if ($o->update($data)) {
                return redirect('/manage/attribute');
            }
        }

        return view('attribute.edit', ['o' => $o]);
    }

    function delete(int $id)
    {
        $o = ModelsAttribute::find($id);
        if ($o->delete()) {
            return redirect('/manage/attribute');
        }
    }
}
