<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
// 切り離した処理のuse
use App\Services\CheckFormData;
// バリデーションクラスのuse
use App\Http\Requests\StoreContactForm;
// クエリビルダ用のuse
use Illuminate\Support\Facades\DB;
// ファットコントローラー:コントローラーが大きくなること
class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        // モデルのデータすべて
        //$contacts = ContactForm::all();
        // クエリビルダを使ってデータをとる
        /*$contacts = DB::table('contact_forms')
        ->select('id', 'your_name', 'title', 'created_at')
        ->orderBy('created_at', 'desc')
        // ページ分け表示の関数
        ->paginate(20);*/
        $query = DB::table('contact_forms');

        if($search !== null){
            // 全角は半角にする
            $search_split = mb_convert_kana($search,'s');
            // 空白で区切る
            $search_split2 = preg_split('/[\s]+/',$search_split, -1, PREG_SPLIT_NO_EMPTY);
            
            foreach($search_split2 as $value){
                $query->where('your_name','like', '%'.$value.'%');
            }   
        }
        $query->select('id', 'your_name', 'title', 'created_at');
        $query->orderBy('created_at', 'asc');
        // ページ分け表示の関数
        $contacts = $query->paginate(20);
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
    public function store(StoreContactForm $request)
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
        $gender = CheckFormData::checkgender($contact);
        $age = CheckFormData::checkage($contact);
   
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
