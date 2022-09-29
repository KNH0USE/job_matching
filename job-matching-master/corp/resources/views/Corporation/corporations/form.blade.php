<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="module" src="{{ asset('/js/corporation/main.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/corporation/style.scss') }}">
@include('Element.global_menu')

<body>
    {{-- 更新↓ --}}
    @if ($isAdd)
    {{ Form::open(['route' => 'corporations.add', 'files' => true]) }}
    @else
    {{ Form::open(['route' => ['corporations.edit', ['id' => Request::get('id')]], 'files' => true]) }}
    @endif
    @csrf
    
    @if (session('flash_message'))
    <div class="flash_message">
      {{ session('flash_message') }}
    </div>
    @endif
      
    <main>
      <h2 class="studentDetail_taitle">{{ $entity['name'] }}<?=__('の編集画面') ?></h2>
      <div class="studentDetail">
        <div class="studentDtail_introduction">
              
        <div class="wrapper">
                
        {{--ロゴのパス --}}
        <section class="form-group leftHarf">            
          <label><?= __('企業ロゴ画像') ?></label>            
          {{ Form::file('corporation_image') }}
          <p class="errors">
            {{-- <img src="https://liginc.co.jp/wp-content/uploads/2015/05/797.png" alt=""> --}}
            {{-- <img src="http://corp.job-matching.com/storage/image/corporation/501/small/zoom%E8%83%8C%E6%99%AF.jp" alt=""> --}}
            @if ($entity['image_path'])
              <img class="logo" src="{{ asset($entity['image_path']['small']) }}" >
            @endif
          </p>
        </section>
        {{-- 企業名 --}}

          <div class="rightHarf">
          
          <section class="form-group">          
            <label><?= __('企業名') ?></label>            
            {{ Form::text('name', $entity['name'] ? $entity['name'] : '', ['maxlength' => 100]) }}
            <p class="errors">
              @if ($errors->has('name'))
              <?= $errors->first('name'); ?>
              @endif
          </p>
        </section>
        {{-- メールアドレス --}}
        <section class="form-group">          
          <label><?= __('メールアドレス') ?></label>
          {{ Form::text('email', old('email') ? old('email') : $entity['email'] ? $entity['email'] : '', ['maxlength' => 50]) }}
          <p class="errors">
            @if ($errors->has('email'))
              <?= $errors->first('email'); ?>
            @endif
          </p>
        </section>
        {{-- 電話番号（会社） --}}
        <section class="form-group">  
          <label><?= __('電話番号') ?></label>          
          {{ Form::text('tel', old('tel') ? old('tel') : $entity['tel'] ? $entity['tel'] : '',) }}
          <p class="errors">
            @if ($errors->has('tel'))
            <?= $errors->first('tel'); ?>
            @endif
          </p>
        </section>
        {{-- 電話番号（携帯） --}}
        <section class="form-group ">
          <label><?= __('携帯電話番号') ?></label>
          {{ Form::text('mobile_tel', old('mobile_tel') ? old('mobile_tel') : $entity['mobile_tel'] ? $entity['mobile_tel'] : '', ['maxlength' => 20]) }}
          <p class="errors">
            @if ($errors->has('mobile_tel'))
              <?= $errors->first('mobile_tel'); ?>
            @endif
          </p>
        </section>
        
        </div>{{-- rightHarf --}}
      </div>{{--wrapper--}}
      
        {{-- 会社URL --}}
        <section class="form-group">  
          <label><?= __('HPのURL') ?></label>
          {{ Form::text('hp_url', old('hp_url') ? old('hp_url') : $entity['hp_url'] ? $entity['hp_url'] : '', ['maxlength' => 150]) }}
          <p class="errors">
            @if ($errors->has('hp_url'))
              <?= $errors->first('hp_url'); ?>
            @endif
          </p>
        </section>
        {{-- 会社の場所 --}}
        <section class="form-group">
          <label><?= __('事業所の所在地') ?></label>
          {{ Form::text('business_location', old('business_location') ? old('business_location') : $entity['business_location'] ? $entity['business_location'] : '', ['maxlength' => 50]) }}
          <p class="errors">
            @if ($errors->has('business_location'))
              <?= $errors->first('business_location'); ?>
            @endif
          </p>
        </section>
        {{-- 代表者名 --}}
        <section class="form-group">
          <label><?= __('代表者') ?></label>
          {{ Form::text('representative', old('representative') ? old('representative') : $entity['representative'] ? $entity['representative'] : '', ['maxlength' => 30]) }}
          <p class="errors">
            @if ($errors->has('representative'))
              <?= $errors->first('representative'); ?>
            @endif
          </p>
        </section>
        {{-- 設立記念日 --}}
        <section class="form-group">          
          <label><?= __('設立年月') ?></label>
          {{ Form::month('establishment_date', old('establishment_date') ? old('establishment_date') : $entity['establishment_date'] ? $entity['establishment_date'] : '') }}
        </section>
        {{-- 資本金 --}}
        <section class="form-group">
          <label><?= __('資本金') ?></label>
          {{ Form::number('capital', old('capital') ? old('capital') : number_format($entity['capital']) ? number_format($entity['capital']) : '') }}
          <p class="errors">
            @if ($errors->has('capital'))
              <?= $errors->first('capital'); ?>
            @endif
          </p>
        </section>
        {{-- 売上高 --}}
        <section class="form-group">
          <label><?= __('売上高') ?></label>
          {{ Form::number('amount_sales', old('amount_sales') ? old('amount_sales') : number_format($entity['amount_sales']) ? number_format($entity['amount_sales']) : '', ['class' => '']) }}
          <p class="errors">
            @if ($errors->has('amount_sales'))
              <?= $errors->first('amount_sales'); ?>
            @endif
          </p>
        </section>
        {{-- 従業員数 --}}
        <section class="form-group">
          <label><?= __('従業員数') ?></label>
          {{ Form::number('employees_number', old('employees_number') ? old('employees_number') : number_format($entity['employees_number']) ? number_format($entity['employees_number']) : '') }}
          <p class="errors">
            @if ($errors->has('employees_number'))
              <?= $errors->first('employees_number'); ?>
            @endif
          </p>
        </section>
        {{-- 事業内容 --}}
        <section class="form-group">          
          <label><?= __('事業内容') ?></label>
          {{ Form::text('business_content', old('business_content') ? old('business_content') : $entity['business_content'] ? $entity['business_content'] : '') }}
          <p class="errors">
            @if ($errors->has('business_content'))
              <?= $errors->first('business_content'); ?>
            @endif
          </p>
        </section>
        {{-- 主要取引先 --}}
        <section class="form-group">
          <label><?= __('主要取引先') ?></label>
          {{ Form::text('main_customer', old('main_customer') ? old('main_customer') : $entity['main_customer'] ? $entity['main_customer'] : '') }}
          <p class="errors">
            @if ($errors->has('main_customer'))
              <?= $errors->first('main_customer'); ?>
            @endif
          </p>
        </section>
        {{-- 部署名 --}}
        <section class="form-group">      
          <label><?= __('部署名') ?></label>
          {{ Form::text('department_name', old('department_name') ? old('department_name') : $entity['department_name'] ? $entity['department_name'] : '', ['maxlength' => 50]) }}
          <p class="errors">
            @if ($errors->has('department_name'))
              <?= $errors->first('department_name'); ?>
            @endif
          </p>
        </section>
        {{-- 担当者名 --}}
        <section class="form-group">
          <label><?= __('担当者名') ?></label>
          {{ Form::text('manager_name', old('manager_name') ? old('manager_name') : $entity['manager_name'] ? $entity['manager_name'] : '',  ['maxlength' => 20]) }}
          <p class="errors">
            @if ($errors->has('manager_name'))
              <?= $errors->first('manager_name'); ?>
            @endif
          </p>
        </section>
        {{-- 業種せれくとぼっくす --}}
        <section class="form-group">  
          <label><?= __('業種ID') ?></label>
          {{ Form::select('industry_id', $industryOptions, old('industry_id') ? old('industry_id') : $entity['industry_id'] ? $entity['industry_id'] : null, ['class' => '']) }}
          <p class="errors">
            @if ($errors->has('industry_id'))
              <?= $errors->first('industry_id'); ?>
            @endif
          </p>
        </section>

        <div class="studentBtn">
          <button><a href="{{route('notifications.index', ['page' => $currentPage])}}"><?= __('戻る') ?></a></button>
          <span>{{ Form::submit('更新する', ['class' => 'btn-submit']) }}</span>
        </div>
            {{-- <a href=""><img src="/images/sideCorporate_EntryRequestbanner.png" alt=""></a> --}}
                
      </div>{{--studentDetail--}}
    </main>
</body>
