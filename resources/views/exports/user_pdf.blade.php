<style>
.table1{
    border:1px solid black;
    border-collapse:collapse;
}
.pp {
    padding:0px;
}
</style>
<div style="text-align:right"><img src="images.png" width="250px" height="30px"></div>
<br>
<hr style="border:0.5px solid black">
<div>
<p style="font-weight:bold">Quotation {{$quotation->refrence_number}}</p>
</div>
<div>
<table>
<tr>
<td>
{{$quotation->customer->name}}<br>
{{$quotation->reason}}
</td>
<td>
<span style="font-weight:bold">Time of validity: </span> until {{$quotation->validity}}<br>
<span style="font-weight:bold">Document Date: </span> {{$quotation->created_at}}<br>
<span style="font-weight:bold">Customer-No: </span> {{$quotation->customer->name}}
</td>
</tr>
<tr>
<td>
<span style="font-weight:bold">Delivery Terms: </span> {{$quotation->payment}}
</td>
<td>
</td>
</tr>
<tr>
<td>
<span style="font-weight:bold">Incoterms: </span> {{$quotation->incoterm}}
</td>
<td>
</td>
</tr>
<tr>
<td colspan="2">For all the deliveries the GEeberit International Sales and Delivery Conditions are applicable and known to client. All prices are exclusive of VAT.</td>
</tr>
<tr>
<td colspan="2"><span style="font-weight:bold">Project: </span> {{$quotation->project_name}}</td>
</tr>
<tr>
<td colspan="2"><span style="font-weight:bold">Remarks: </span> {{$quotation->remarks}}</td>
</tr>
</table>

<table class="table1" style="padding-top:30px;">
<thead>
<tr class="table1">
   <th class="table1"  style="font-weight:bold">SR NO.</th>
   <th class="table1" style="font-weight:bold;text-align:left" colspan="2">Article-No Description</th>
   <th class="table1" style="font-weight:bold">Discount</th>
   <th class="table1" style="font-weight:bold" colspan="2">ListPrice</th>
   <th class="table1" style="font-weight:bold" colspan="2">Net-Price</th>
   <th class="table1" style="font-weight:bold">Quantity</th>
   <th class="table1" style="font-weight:bold">Unit</th>
   <th class="table1" style="font-weight:bold" colspan="2">Total Amount</th>
   <th class="table1" style="font-weight:bold" colspan="3">Country Origin</th>
   <th class="table1" style="font-weight:bold" colspan="5">Origin Company</th>
   </tr>
</thead>
<tbody>
@foreach($quotation1 as $key=> $quo)
        <tr class="table1">
        <td class="table1" style="text-align:left">{{$key+1}}</td>
        <td class="table1"  colspan="2" style="text-align:left">{{ $quo->product->material_number }} {{$quo->product_description}}</td>
         <td class="table1" style="text-align:left">{{$quo->discount}}</td>
        <td class="table1" colspan="2" style="text-align:left">@if ($quotation->currency=='USD'){{$quotation->currency}} {{$quo->product->list_price_usd}} 
        @else {{$quotation->currency}} {{$quo->product->list_price_sgd}}
        @endif
        </td>
        <td class="table1" colspan="2">{{$quotation->currency}} {{$quo->unit_price}}</td>
        <td class="table1" colspan="" style="text-align:left">{{$quo->quantity}}</td>
        <td class="table1" colspan="">{{$quo->product->base_unit}}</td>
        <td class="table1" colspan="2">{{$quotation->currency}} {{$quo->discount_unit_price}}</td>
        <td class="table1" colspan="3">{{$quo->product->country['name']}}</td>
        <td class="table1" colspan="5">{{$quo->product->origin_company}}</td>
        </tr>
        @endforeach
</tbody>
</table>
<h5 style="text-align: right; padding-right: 10px;">
Grand Total: {{$quotation->currency}} {{$quotation->quotation_cost}}
</h5>
<div style="position: absolute; bottom: 10px; border:1px solid black; padding:10px;">
<span style="font-weight:bold;">Disclaimer:</span><br>
All proposed prices are valid before the above-mentioned validity date. Thereafter, they are subject to change by Geberit without notice.
Unit prices are based on the quantities quoted and are subject to change if the quantity ordered differs from the quantities quoted.
Products quoted are subject to availability and may be substituted with equal or better products.
<br>
<span style="font-weight:bold;">Geberit South East Asia Pte Ltd </span> - 8 Kallang Avenue - Aperia, Tower 1, #17-09 Singapore 339509
Phone: (65)6250 4011 - Fax: (65)6250 4211 - sales.sg@geberit.com - www.geberit.com - Co.Reg.No.: 199800372G, GST Reg.No.:
19-9800372-G
</div>
</div>