 @if (isset($hasMessage))
  <div id="notification" style="margin-top:5px">
    <!-- info, success, warning, danger -->
    <div class="alert alert-{{$msgType}}" role="alert">
      <strong>{{$msgTitle}}</strong> {{$msgMessage}}.
    </div>
  </div>
  <div class="clr"></div>
@endif