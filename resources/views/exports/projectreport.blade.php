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
   <th style="font-weight:bold;text-align:left" colspan="4">Status</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Created By</th>
   <th style="font-weight:bold;text-align:left" colspan="5">Approved/Rejected By</th>
   <th style="font-weight:bold;text-align:left" colspan="4">Validity</th>
   </tr>
    </thead>   
    <tbody>
        @foreach($quotation as $key=> $quo)
        <tr >
        <td style="text-align:left">{{$key+1}}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->refrence_number }}</td>
        <td  colspan="4" style="text-align:left">
        @if($quo->project_name) {{ $quo->project_name }}
            @else -
        @endif
        </td>
        <td  colspan="4" style="text-align:left">{{ $quo->customer->name }}</td>
        <td  colspan="2" style="text-align:left">{{ $quo->currency }}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->quotation_cost }}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->status }}</td>
        <td  colspan="4" style="text-align:left">{{ $quo->user->name }} ({{$quo->user->role->display_name}})</td>
        <td  colspan="4" style="text-align:left"> 
        @if($quo->status == 'PENDING')
            @if($quo->approved_by == null) - @endif
            @if($quo->users) {{$quo->users->name}} ({{$quo->user->role->display_name}}) @endif
        @else
            @if($quo->users) {{$quo->users->name}} ({{$quo->user->role->display_name}})
            @else - @endif
        @endif
       </td>
       <td  colspan="4" style="text-align:left">
       @if($quo->validity) {{$quo->validity}}
            @else -
       @endif
       </td>
      </tr>
        @endforeach
    </tbody>
</table>
