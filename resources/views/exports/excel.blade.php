<style>
th{
    text-align:right !important;
}
</style>
<table>
    <thead>
    <tr>
        <th colspan="4" style="font-weight:bold">Quotation {{$quotation->refrence_number}} R-{{$quotation->revision}}</th>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
   <th colspan="10"> {{$quotation->customer->name}}</th>
   <th colspan="4" style="font-weight:bold">Time of validity:</th>
   <th colspan="4">{{$quotation->validity}}</th>
   </tr>
   <tr>
   <th colspan="10"> {{$quotation->project_name}}</th>
   <th colspan="4" style="font-weight:bold">Document Date:</th>
   <th colspan="4">{{$quotation->created_at}}</th>
   </tr>
   <tr>
   <th colspan="10"> </th>
   <th colspan="4" style="font-weight:bold">Customer-No:</th>
   <th colspan="4">{{$quotation->customer->name}}</th>
   </tr>
   <tr></tr>
   <tr></tr>
   <tr>
   <th colspan="5" style="font-weight:bold">Delivery Terms:</th>
   <th colspan="5">{{$quotation->payment}}</th>
   </tr>
   <tr>
   <th colspan="5" style="font-weight:bold">Incoterms:</th>
   <th colspan="5">{{$quotation->incoterm}}</th>
   </tr>
   <tr></tr>
   <tr>
   <th colspan="15">For all the deliveries the GEeberit International Sales and Delivery Conditions are applicable and known to client. All prices are exclusive of VAT.</th>
   </tr>
   <tr></tr>
   <tr>
   <th colspan="5" style="font-weight:bold">Project:</th>
   <th colspan="5">{{$quotation->project_name}}</th>
   </tr>
   <tr>
   <th colspan="5" style="font-weight:bold">Remarks:</th>
   <th colspan="5">{{$quotation->remarks}}</th>
   </tr>
   <tr></tr>
   <tr></tr>
   <tr>
   <th style="font-weight:bold">SR NO.</th>
   <th style="font-weight:bold;text-align:left" colspan="2">Article-No</th>
   <th style="font-weight:bold" colspan="5">Description</th>
   <th style="font-weight:bold">Discount</th>
   <th style="font-weight:bold" colspan="2">ListPrice</th>
   <th style="font-weight:bold" colspan="2">Net-Price</th>
   <th style="font-weight:bold">Quantity</th>
   <th style="font-weight:bold">Unit</th>
   <th style="font-weight:bold" colspan="2">Total Amount</th>
   <th style="font-weight:bold" colspan="3">Country Origin</th>
   <th style="font-weight:bold" colspan="5">Origin Company</th>
   </tr>
   <tr></tr>
   <tr>
   
   </tr>
    </thead>   
    <tbody>
        @foreach($quotation1 as $key=> $quo)
        <tr >
        <td style="text-align:left">{{$key+1}}</td>
        <td  colspan="2" style="text-align:left">{{ $quo->product->material_number }}</td>
        <td colspan="5">{{$quo->product_description}}</td>
         <td style="text-align:left">{{$quo->discount}}</td>
        <td colspan="2" style="text-align:left">@if ($quotation->currency=='USD'){{$quotation->currency}} {{$quo->product->list_price_usd}} 
        @else {{$quotation->currency}} {{$quo->product->list_price_sgd}}
        @endif
        </td>
        <td colspan="2">{{$quotation->currency}} {{$quo->unit_price}}</td>
        <td colspan="" style="text-align:left">{{$quo->quantity}}</td>
        <td colspan="">{{$quo->product->base_unit}}</td>
        <td colspan="2">{{$quotation->currency}} {{$quo->discount_unit_price}}</td>
        <td colspan="3">{{$quo->product->country['name']}}</td>
        <td colspan="5">{{$quo->product->origin_company}}</td>
        </tr>
        @endforeach
        <tr></tr>
        <tr>
        <th colspan="16"></th>
        <th colspan="3">Grand Total:</th>
        <th colspan="5" style="font-weight:bold;">{{$quotation->currency}} {{$quotation->quotation_cost}}</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
        <th colspan="10">Geberit South East Asia Pte Ltd - 8 Kallang Avenue - Aperia, Tower 1, #17-09 Singapore 339509</th>
        </tr>
        <tr>
        <th colspan="16">Phone: (65)6250 4011 - Fax: (65)6250 4211 - sales.sg@geberit.com - www.geberit.com - Co.Reg.No.: 199800372G, GST Reg.No.: 19-9800372-G</th>
        </tr>

    </tbody>
</table>