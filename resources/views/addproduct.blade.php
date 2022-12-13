
@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
        <header>

        </header>

        <main>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="Base">
                <h2>商品検索</h2>
                <form action="{{ url('/home/add_product') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <ul>
                        <li>
                            商品名<br>
                            <input type="text" class="Base__size--input" name="txtFaddproduct" value="{{old('txtFaddproduct')}}">
                        </li>

                        <li>
                            メーカー名<br>
                            <select class="Base__size--input" name="drpFaddcompany" >
                                <option></option>
                                @foreach ($companylist as $val1)
                                    <option value= {{$val1->id}}>{{$val1->company_name}}</option>
                                @endforeach
                            </select>
                        </li>

                        <li>
                            価格<br>
                            <input type="text" class="Base__size--input" name="txtFaddprice" value="{{old('txtFaddprice')}}">
                        </li>

                        <li>
                            在庫数<br>
                            <input type="text" class="Base__size--input" name="txtFaddstock" value="{{old('txtFaddstock')}}">
                        </li>

                        <li>
                            コメント<br>
                            <textarea class="Base__size--input" rows="3" cols="40" name="txtFaddcomment"></textarea>
                        </li>

                        <li>
                            商品画像<br>
                            <input type="file" name="imgFaddimage" accept="image/png, image/jpeg">
                        </li>

                        <li>
                            <button type="submit" class="Base__size--input">追加</button>
                        </li>
                    </ul>
                </form> 
            </div>

            <button onclick="location.href='/step7task/public/home/'"  type="button" class="Base__size--full" name="btnFaddproduct">戻る</button>
        </main>
    </body>
    @endsection
