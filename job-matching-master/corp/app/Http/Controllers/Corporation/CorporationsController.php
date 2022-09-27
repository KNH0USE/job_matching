<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\database\factories\CorporationsFactory;
// バリデーションチェックパス↓
use App\Http\Requests\CorporationsRequest;
use App\Http\Controllers\Controller;
use App\Services\Corporation\CorporationsService;
// 画像↓
use App\Services\Common\Image\GenerateImageService;
use App\Services\Common\Image\DestroyImageService;


use Illuminate\Session\TokenMismatchException;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Exception\NotWritableException;
use Illuminate\Http\Exceptions\PostTooLargeException;

class CorporationsController extends Controller
{
    private $corporation;
    private $gImage;
    private $dImage;
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(CorporationsService $corporation, GenerateImageService $gImage, DestroyImageService $dImage)
    {
        parent::__construct();
        $this->corporation = $corporation;
        $this->gImage = $gImage;
        $this->dImage = $dImage;
    }
    public function index(Request $request)
    {

    }

    // public function add(CorporationsRequest $request)
    // {
    //     return view('Corporation.corporations.form', compact('entity','isAdd','currentPage'));
    // }

    public function edit(CorporationsRequest $request)
    {
        $entity = null;
        // セッション初期化、編集完了時のページ保持
        if (!$request->session()->has('page') || null != $request->page && $request->session()->get('page') != $request->page) {
            $request->session()->regenerate();
            $request->session()->put('page', $request->page);
        }
        $currentPage = $request->page;

        // todo ログインIDに属するIDでないものをエラーで弾く
        !$request->id ? abort(404, 'データが見つかりませんでした')
        : !is_numeric($request->id) ? abort(500, 'パラメータが不正です')
        : $entity = $this->corporation->getById($request->id);
        if (!$entity) abort(500, 'データが存在しません');

        if ($request->isMethod('POST')) {

            $data = $request->all();
            try {
                // 多重送信防止
                if (!Cache::add('used_token.'.$request->session()->token(), 1, 1)) {
                    # 使用済みだったときの処理
                    # TokenMismatchExceptionを投げる(CSRFトークン不一致の扱いにする)
                    throw new TokenMismatchException();
                }
            } catch (\Exception $e) {
                abort(500, 'トークンが不正です');
            }

        // 画像保存
        if (isset($data) && !empty($data['corporation_image'])) {
            try {
                $fileName = $data['corporation_image']->getClientOriginalName();
                if (!$fileName) {
                    throw new \Exception();
                }
                $savePaths = $this->gImage->__construct('corporation', $request->id, $data['corporation_image'], $fileName);
                if (empty($savePaths)) {
                    throw new \Exception();
                }
                $data['image_path'] = json_encode($savePaths);

            } catch (NotReadableException $e) {
                abort(500, 'ファイルを読み込めませんでした');
            } catch (NotWritableException $e) {
                try {
                    $this->dImage->__construct('corporation', $savePaths);
                } catch (\Exception $e) {
                    abort(500, 'ファイルを削除できませんでした');
                }
                abort(500, 'ファイルを書き込めませんでした');
            } catch (PostTooLargeException $e) {
                abort(500, 'ファイルサイズが大きすぎます');
            } catch (\Exception $e) {
                try {
                    $this->dImage->__construct('corporation', $savePaths);
                } catch (\Exception $e) {
                    abort(500, 'ファイルを削除できませんでした');
                }
                abort(500, '予期せぬエラーが発生しました');
            }
        }

            $result = false;
            $data = $this->corporation->convertData($data);

            // dd($data);
            isset($data) && array_key_exists('name', $data) && array_key_exists('email', $data)
            && array_key_exists('tel', $data) && array_key_exists('mobile_tel', $data)
            && array_key_exists('hp_url', $data)
            && array_key_exists('business_location', $data) && array_key_exists('representative', $data)
            && array_key_exists('establishment_date', $data) && array_key_exists('capital', $data)
            && array_key_exists('amount_sales', $data) && array_key_exists('employees_number', $data)
            && array_key_exists('business_content', $data) && array_key_exists('main_customer', $data)
            && array_key_exists('department_name', $data) && array_key_exists('manager_name', $data)
            && array_key_exists('industry_id', $data)
            ? $result = $this->corporation->save($entity, $data)
            : abort(500, 'パラメータが不正です');
            if(!$result) abort(500, 'データを保存できませんでした');

            $currentPage = $request->session()->get('page');
            $request->session()->forget('page');

            // トークンを再生成
            $request->session()->regenerateToken();
            // edit=?id●●の場所にリダイレクト
            return redirect()->route('corporations.edit', ['id' => $request->id])->with('flash_message', '保存しました');
        }
        !$request->isMethod('GET') ? abort(500, '不正なリクエストです')
        : !$request->id ? abort(404, 'データが見つかりませんでした')
        : !is_numeric($request->id) ? abort(500, 'パラメータが不正です')
        : $entity = $this->corporation->getById($request->id, []);
        !$entity ? abort(500, 'データが存在しません')
        : $currentPage = $request->page;

        if (!$request->isMethod('GET')) abort(500, '不正なリクエストです');
        $isAdd = preg_match('/add/', url()->current()) === 1;
        $industryOptions = $this->corporation->getIndustryOptions();

        //画像保存↓
        if (!empty($entity['image_path'])) {
            $entity['image_path'] = json_decode($entity['image_path'], true);
        }

        return view('Corporation.corporations.form', compact('entity','isAdd','currentPage','industryOptions'));
    }

    public function view(Request $request)
    {
        !$request->isMethod('GET') ? abort(500, '不正なリクエストです')
        : !$request->id ? abort(404, 'データが見つかりませんでした')
        : !is_numeric($request->id) ? abort(500, 'パラメータが不正です')
        // : $entity = $this->corporation->getById($request->id, ['contain' => ['job']]);
        : $entity = $this->corporation->getById($request->id, []);
        !$entity ? abort(500, 'データが存在しません')
        : $currentPage = $request->page;

        return view('Corporation.corporations.view', compact('entity','currentPage'));
    }

    public function delete(Request $request)
    {

    }
}
