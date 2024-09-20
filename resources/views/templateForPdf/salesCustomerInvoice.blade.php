
<!DOCTYPE html>
<html>
<head>
    <title>PDF Document</title>
    <style>
        /* Add any custom styles here */
    </style>
</head>
<body>
   
    
    <section class="invoice" style="width: 710px; margin-left: auto; margin-right: auto;">
    
    
                <div class="fixhight">
                
                    <div align="center">
                        <div style="width:350px;">
                                                                <img class="img-responsive pull-left" src="http://www.allmarch.groupdecent.com/html/dist/img/logo/invoice_logo.png" alt="User profile picture">
                                                        <div style="padding-top:15px;">
                                                                <i style="font: 18px Times New Roman, Arial;"><b>All-March Bangladesh Limited</b></i><br>
                                    <i style="color:grey; font: 16px Blackadder ITC, Arial;">We are always around you</i>
                                                        </div>
                        </div>
                    </div>
                    <!-- title row -->
                    <div class="row">
    
                        <div class="col-xs-12">
                            <div class="text-center">
                                <h3>Invoice</h3>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    
                    <div class="row">
                    
                        <div class="col-xs-6">
                            <div class="col-xs-12 hidden-print">
                                <input id="originalname" value="Mondol Fabrics Limited (Printing Section)" type="hidden">
                            </div>
                            
                            <div class="col-xs-12">
                                Name: <input style="border-style:none; background-color:transparent; width:80%;" id="customername" name="customername" value="Mondol Fabrics Limited (Printing Section)">
                            </div>
    
                            <div class="col-xs-12">
                                Phone : N/A                        </div>
    
                            <div class="col-xs-12">
                                <address>Nayapara, Kashimpur, Gazipur</address>
                            </div>
    
                        </div>
    
                        <div class="col-xs-6">
                        
                            <div class="col-xs-12 text-right">
                                Date : 19/09/2024                        </div>
    
                            <div class="col-xs-12 text-right">
                                Invoice No : 25210                        </div>
    
                            <div class="col-xs-12 text-right">
                                Delivery Receipt No : 55210                        </div>
    
                            <div class="col-xs-12 text-right hidden">
                                <input style="border-style:none; background-color:transparent; text-align:right; width:100%;" value="Order Ref : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                            </div>
    
                        </div>
    
                        <div class="col-xs-12 text-right">
                            <input style="border-style:none; background-color:transparent; text-align:right; width:100%;" value="Order Ref : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                        </div>
    
                    </div>
    
                    <!-- ID Hidden -->
                    <input class=" fa-th form-control" style="background-color:transparent;" value="25210" id="invoice_id" name="invoice_id" type="hidden">
                    
                   
                    <div class="row">
                        <div class="col-xs-12">
                           
                             <div class="col-xs-12 hidden-print"> 
        
                                <div class="col-xs-6">
                                    <div class="input-group pull-left">
                                        <div class="checkbox">
                                            <label>
                                                                                                <input class="checkbox pull-right" style="height:25px; width:25px;" type="checkbox" id="invoice_batch_flag" name="invoice_batch_flag" title="Click to Show Hide Batch Number" checked="checked" onchange="InvoiceBatchFlag()">
                                                                                        </label>
                                            <b>&nbsp;&nbsp;&nbsp;S H O W - B A T C H - N U M B E R</b>
                                        </div>
                                    </div>
                                 </div>
        
                                <div class="col-xs-4 pull-right">
                                    <a class="btn btn-default pull-right" href="javascript:window.print(); setTimeout(window.close, 0);"><i class="fa fa-print fa-2x" aria-hidden="true"></i></a>
                                </div>
                                 
                            </div>
                             
                            <input style="border-style:none; background-color:transparent; width:92%; text-align:right;" id="invoicePayable_backup" value=" 716,500.00" hidden="hidden"><table>
                                <thead>
                                    <tr align="center" style="background-color:lightgray;">
                                        <th width="5%" style="text-align:center;">SL.</th>
                                        <th width="30%">Product Name</th>
                                        <th width="20%" style="text-align:center;" class="icbc">Batch No.</th>
                                        <th width="10%" style="text-align:center;">Quantity</th>
                                        <th width="15%" style="text-align:center;">Unit price(Tk)</th>
                                        <th width="20%" style="text-align:center;">Total Price(Tk)</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                                                                                                                
                                                                                                            <tr>
                                                                                        <td align="center">01</td>
                                                
                                                                                    
                                            
                                            
                                            
        
                                            <!-- ********** Special Price **************** -->
                                                                                    <!-- ********** Special Price **************** -->
                                            
                                            
                                            
                                            
                                            
                                            <td>Ecoplast White </td>
                                            
                                            <td align="center" class="icbc">ECW 1412202325</td>
                                            
                                            <td align="center">90.00 Kg</td>
                                            
                                            <td align="center"><input style="border-style:none; background-color:transparent; width:100%; text-align:center;" value="2,100.00"></td>
                                            <!--  
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            -->
                                            <td align="right"> 189,000.00 Tk</td>
                                        </tr>
                                                                                                            <tr>
                                                                                        <td align="center">02</td>
                                                
                                                                                    
                                            
                                            
                                            
        
                                            <!-- ********** Special Price **************** -->
                                                                                    <!-- ********** Special Price **************** -->
                                            
                                            
                                            
                                            
                                            
                                            <td>Ecoplast High density Gel </td>
                                            
                                            <td align="center" class="icbc">EGB 2812202325</td>
                                            
                                            <td align="center">100.00 Kg</td>
                                            
                                            <td align="center"><input style="border-style:none; background-color:transparent; width:100%; text-align:center;" value="2,350.00"></td>
                                            <!--  
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            -->
                                            <td align="right"> 235,000.00 Tk</td>
                                        </tr>
                                                                                                            <tr>
                                                                                        <td align="center">03</td>
                                                
                                                                                    
                                            
                                            
                                            
        
                                            <!-- ********** Special Price **************** -->
                                                                                    <!-- ********** Special Price **************** -->
                                            
                                            
                                            
                                            
                                            
                                            <td>Ecoplast Thinner </td>
                                            
                                            <td align="center" class="icbc">THN 2512202325</td>
                                            
                                            <td align="center">150.00 Kg</td>
                                            
                                            <td align="center"><input style="border-style:none; background-color:transparent; width:100%; text-align:center;" value="1,950.00"></td>
                                            <!--  
                                            <td align="center"></td>
                                            <td align="center"></td>
                                            -->
                                            <td align="right"> 292,500.00 Tk</td>
                                        </tr>
                                                                                                                    
                                <tr>
                                    <td style="visibility:hidden;"></td>
                                    <td style="visibility:hidden;" class="icbc"></td>
                                    <td style="visibility:hidden;"></td>
                                    <td align="center"><strong>340.00</strong> Kg</td>
                                    <td align="right"><strong>Total Amount</strong></td>
                                    <td align="right"><strong> 716,500.00</strong> Tk</td>
                                </tr>
    
                                                    
                                <tr>
                                    <td style="visibility:hidden;"></td>
                                    <td style="visibility:hidden;" class="icbc"></td>
                                    <td style="visibility:hidden;"></td>
                                    <td style="visibility:hidden;"></td>
                                    <td align="right">Paid Amount</td>
                                    <td align="right"><strong></strong> Tk</td>
                                </tr>
                        
                                <tr>
                                    <td style="visibility:hidden;"></td>
                                    <td style="visibility:hidden;" class="icbc"></td>
                                    <td style="visibility:hidden;"></td>
                                    <td style="visibility:hidden;"></td>
                                    <td align="right"><strong>Total Payable</strong></td>
                                    <td align="right"><strong> 716,500.00</strong> Tk</td>
                                    <!-- Hidden -->
                                    
                                </tr>
    
                                </tbody>
                            </table>
                            In Word: <b>Seven Lakh Sixteen Thousand Five Hundred Only</b>
                            
                             
                            <!-- /Statement Update................................... -->
                                                    <!-- /Statement Update...................................... -->
                        </div>
                    </div>
                    
                                            
                                                <div class="row mymarginexp">
                                <br>
                                <br>
                                <br>
                                <div class="col-xs-4 pull-right">
                                    <div class="text-right">....................................................................</div>
                                  <div class="text-center">Authorized By</div>
                                </div>
                                <div class="col-xs-4 pull-left">
                                    <div class="text-left">.......................................................</div>
                                    <div class="text-center">Received By</div>
                                </div>
                            </div>
                                        
                </div>
                
                   <div align="center" class="footer">
                    <br>
                    <br>
                    <br>
                    <br>
                                        <p>House# 1/A, Road# 15, Nikunju-2, Khilkhet, Dhaka-1229, Contact: +8801713221101-10, E-mail: info@all-marchbd.com</p>
                                         
                                                    <p align="right">Delivery By: Mr. Miraz</p>
                </div>
                
                
            </section>
</body>
</html>