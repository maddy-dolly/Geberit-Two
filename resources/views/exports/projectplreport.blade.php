<style>
th{
    text-align:right !important;
}
</style>
<table>
    <thead>
   
   <tr>
   <th style="font-weight:bold">SR NO.</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Reference Number</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Project Name</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Customer Name</th>
   <th style="font-weight:bold;text-align:left" colspan="2">Currency</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Amount</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Created By</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Country</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Validity Date</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 11</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 12 OEM</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 12</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 21</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 22</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 31</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 32</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 33</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 34</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 35</th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 21 Tool </th>
   <th style="font-weight:bold;text-align:left" colspan="4">PL 22 Tool</th>
   </tr>
    </thead>   
    <tbody>
        @foreach($quotation as $key=> $quo)
        <tr >
        <td style="text-align:left">{{$key+1}}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->refrence_number }}  
        @if($quo->revision == 0) 
          @else R-{{$quo->revision}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->project_name) {{ $quo->project_name }}
            @else -
        @endif
        </td>
        <td  colspan="4" style="text-align:left">{{ $quo->customer->name }}</td>
        <td  colspan="2" style="text-align:left">{{ $quo->currency }}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->quotation_cost }}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->user->name }} ({{$quo->user->role->display_name}})</td>
        <td  colspan="4" style="text-align:left">{{ $quo->customer->country->name }}</td>
        <td  colspan="4" style="text-align:left">
       @if($quo->validity) {{$quo->validity}}
            @else -
       @endif
       </td>
       <td  colspan="4" style="text-align:left">
        @if($quo->pl11 == 0) -
            @else {{ $quo->pl11}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl12_oem == 0) -
            @else {{ $quo->pl12_oem}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl12 == 0) -
            @else {{ $quo->pl12}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl21 == 0) -
            @else {{ $quo->pl21}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl22 == 0) -
            @else {{ $quo->pl22}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl31 == 0) -
            @else {{ $quo->pl31}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl32 == 0) -
            @else {{ $quo->pl32}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl33 == 0) -
            @else {{ $quo->pl33}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl34 == 0) -
            @else {{ $quo->pl34}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl35 == 0) -
            @else {{ $quo->pl35}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl21_tool == 0) -
            @else {{ $quo->pl21_tool}}
        @endif
        </td>
        <td  colspan="4" style="text-align:left">
        @if($quo->pl22_tool == 0) -
            @else {{ $quo->pl22_tool}}
        @endif
        </td>
       
      </tr>
        @endforeach
    </tbody>
</table>
