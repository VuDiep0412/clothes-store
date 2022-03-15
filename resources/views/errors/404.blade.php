@extends('frontend.layouts.main')

<style>

#notfound {
  position: relative;
  height: 70vh;
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  margin-top: 80px;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound {
  max-width: 520px;
  width: 100%;
  line-height: 1.4;
  text-align: center;
}

.notfound .notfound-404 {
  position: relative;
  height: 240px;
}

.notfound .notfound-404 h1 {
  font-family: 'Montserrat', sans-serif;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  font-size: 252px;
  font-weight: 900;
  margin: 0px;
  color: #262626;
  text-transform: uppercase;
  letter-spacing: -40px;
  margin-left: -20px;
}

.notfound .notfound-404 h1>span {
  text-shadow: -8px 0px 0px #fff;
}

.notfound .notfound-404 h3{
  font-family: 'Cabin', sans-serif;
  position: relative;
  font-size: 20px;
  font-weight: 700;
  text-transform: uppercase;
  color: #262626;
  margin: 0px;
  letter-spacing: 3px;
  padding-left: 6px;
}

.notfound .home-btn {
  font-family: 'Montserrat', sans-serif;
  display: inline-block;
  font-weight: 700;
  text-decoration: none;
  border: 2px solid black;
  text-transform: uppercase;
  padding: 13px 25px;
  font-size: 18px;
  border-radius: 40px;
  margin: 7px;
  margin-top: 60px;
  margin-bottom: 150px;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
}

.notfound .home-btn:hover {
  opacity: 0.9;
}

.notfound .home-btn {
  color: black;
  background: #fff;
}

@media only screen and (max-width: 767px) {
  .notfound .notfound-404 {
    height: 200px;
  }
  .notfound .notfound-404 h1 {
    font-size: 200px;
  }
}

@media only screen and (max-width: 480px) {
  .notfound .notfound-404 {
    height: 162px;
  }
  .notfound .notfound-404 h1 {
    font-size: 162px;
    height: 150px;
    line-height: 162px;
  }
  .notfound h2 {
    font-size: 16px;
  }
}

</style>
@section('content')
  
<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h3>Ồ... Trang không tồn tại</h3>
				<h1><span>4</span><span>0</span><span>4</span></h1>
			</div>
           
			<!-- <h4>Rất tiếc, trang bạn tìm kiếm không tồn tại</h4> -->
            <a href="{{route('shop.index')}}" class="home-btn">Về trang chủ</a>
		</div>
        
	</div>

@endsection


