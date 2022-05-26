<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
// クエリビルダ用のuse
use Illuminate\Support\Facades\DB;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // モデルのデータすべて
        //$contacts = ContactForm::all();
        // クエリビルダを使ってデータをとる
        $contacts = DB::table('contact_forms')
        ->select('id', 'your_name', 'title', 'created_at')
        ->orderBy('created_at', 'desc')
        ->get();
        // .　がフォルダの区切り
        return view('contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // laravelではRequestクラスでデータをもってこれる $_POSTでやってたこと
    public function store(Request $request)
    {
        $contact = new ContactForm;

        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();

        return redirect('contact/index');
        // paramが入っているか確認 ハイライト表示で返ってくる
        // dd($your_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactForm::find($id);
        //$gender = '';
        // 教材ではif文の連続でした
        if($contact->gender === 0){
            $gender = '男性';
        }elseif($contact->gender === 1){
            $gender = '女性';
        }
        $agevalue = $contact->age;

        switch($agevalue){
            case 1:
                $age ='~19歳';
            break;    
            case 2:
                $age ='20~29歳';
            break;
            case 3:
                $age ='30~39歳';
            break;
            case 4:
                $age ='40~49歳';
            break;
            case 5:
                $age ='50~59歳';
            break;
            case 6:
                $age ='60歳~';
            break;
        }
        return view('contact.show', compact('contact', 'gender', 'age')); // 変数は複数渡せる
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = ContactForm::find($id);
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = ContactForm::find($id);

        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();

        return redirect('contact/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = ContactForm::find($id);

        $contact->delete();

        return redirect('contact/index');
    }
}
