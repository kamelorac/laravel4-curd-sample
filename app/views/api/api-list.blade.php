 @extends('api.api-master')

@section('content')
 Operations:
	  	<div id="no-more-tables" class="tbl">

        <table class="table-bordered table-striped table-condensed cf" id="tblContainer" style="width: 100%">
            <thead class="cf">
          
                <tr>
                    <th class="header" width="100%" colspan="2" style="text-align:center">SongTrek Web Services</th>
                    
                </tr>
            </thead>
            <tbody>
             <tr>
                    <td > User</td>
                    <td>
                    <a href="{{ URL::to('api/userservices') }}" role="button"  class="btn">json</a>
                  
                    </td>
                </tr>
                <tr>
                   <td width="80%"> Profile</td>
                    
                    <td >
                    <a href="{{ URL::to('api/profileservices') }}" role="button"  class="btn">json</a>
                   
                    </td>
                </tr>
                 <tr>
                    <td > Labrary</td>
                    <td>
                    <a href="{{ URL::to('api/libraryservices') }}" role="button"  class="btn">json</a>
                  
                    </td>
                </tr>
                <tr>
                    <td > Radio</td>
                    <td>
                    <a href="{{ URL::to('api/radioservices') }}" role="button"  class="btn">json</a>
                  
                    </td>
                </tr>
                <tr>
                    <td > Song</td>
                    <td>
                    <a href="{{ URL::to('api/songservices') }}" role="button"  class="btn">json</a>
                  
                    </td>
                </tr>

              
            </tbody>
        </table>
    </div>
 @endsection 	