@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <h1>About Us</h1>
  </div>
  <div class="container">
    <div class="static-content">
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-4 md:gap-y-12 gap-10">
        <div>
          <h3 class="heading3 border-line">&nbsp;</h3>
          <p>Madhya Pradesh, the incredible heart of India embodies a blend of architectural grandeurs, pristine &amp; unexplored destinations and cultural values. It is indeed a one stop destination for both national and international tourists. The state is endowed with a rich heritage and is known for its numerous monuments, palaces, fortresses, stupas, diverse wildlife, beautifully engraved Asian temples and hill stations.</p>
        </div>
        <div>
          <img src="{{url('images/dughdhara.jpeg')}}" alt="dughdhara" />
        </div>
        <div>
          <img src="{{url('images/Chitragupt-Temple.jpg')}}" alt="Chitragupt-Temple" />
        </div>
        <div>
          <h3 class="heading3 border-line">&nbsp;</h3>
          <p>Apart from having UNESCO approved world heritage sites like the Khajuraho Group of Monuments, Sanchi Stupa and Rock Shelters of Bhimbetka, the state is home to 10 stunning national parks, 25 wonderful wildlife centuries and 6 tremendous Tiger Reserves. Moreover, constantly achieving the conservation commitments, the state has proudly gained and maintained a status of the 'Tiger State of India'.</p>
        </div>
        <div>
          <h3 class="heading3 border-line">&nbsp;</h3>
          <p>You are looking forward to reconnoiter some really wonderful landscapes, delicious cuisines, world heritage sites and beautiful handicrafts then come discover the heart stopping beauty of Madhya Pradesh.</p>
        </div>
        <div>
          <img src="{{url('images/The-Great-Stupa.jpg')}}" alt="The-Great-Stupa" />
        </div>
      </div>
    </div>
  </div>
@endsection
