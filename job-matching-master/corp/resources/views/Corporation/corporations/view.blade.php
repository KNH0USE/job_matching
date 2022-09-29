<link rel="stylesheet" href="{{ asset('css/corporation/style.scss') }}">

@include('Element.global_menu')

    <strong> {{ $entity['name'] }}<?= __('の会社情報') ?><br>
      <a class="text-info" href="{{ $entity['hp_url'] }}">{{ $entity['hp_url'] }}</a>
    </strong>
  

      <ul>
        <li><a href="">リクルート情報</a></li>
        <li><a href="">会社情報</a></li>
      </ul>
     

      <table>
          <tr>
            <th><?= __('代表者名') ?></th>
            <td>{{ $entity['representative'] }}</td>
          </tr>

          <tr>
            <th><?= __('本所在地住所') ?></th>
            <td>{{ $entity['business_location'] }}</td>
          </tr>
          
          <tr>
            <th><?= __('設立年月') ?></th>
            <td>{{ $entity['establishment_date']->format('Y年m月') }}</td>
          </tr>
          
          <tr>
            <th><?= __('資本金') ?></th>
            <td>{{ number_format($entity['capital']) }}円</td>
          </tr>
          
          <tr>
            <th><?= __('売上高') ?></th>
            <td>{{ number_format($entity['amount_sales']) }}円</td>
          </tr>
          
          <tr>
            <th><?= __('従業員数') ?></th>
            <td>{{ $entity['employees_number'] }}名</td>
          </tr>
          
          <tr>
            <th><?= __('主要取引先') ?></th>
            <td>{{ $entity['main_customer'] }}</td>
          </tr>
          
          <tr>
            <th><?= __('業種') ?></th>
            <td>{{ $entity->industry ? $entity->industry->name : ''}}</td>
          </tr>
          
          <tr>
            <th><?= __('事業内容') ?></th>
            <td>{{ $entity['business_content'] }}</td>
          </tr>
      </table>

      <button class="backbtn">
        <a href="{{route('samples.index', ['page' => $currentPage])}}">
          <span><?= __('戻る') ?></span>
        </a>
      </button>