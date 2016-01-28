@extends('main')

@section('content')



                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            Bank Transactions
                          
                            </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                    <div class="x_title">

                                    <?php if(true){ ?>
                                    <div class="x_panel">
                                        <h5 class='pull-left'>
                                      
                                        {{ $bankaccount->account_name }} - <span id="bankaccountno">{{ $bankaccount->account_no }}</span>

                                       
                                        </h5>

                                        <h4 class='pull-right'>
                                            <small>Current Bal : </small>GHS {{ number_format($bankaccount->ini_bal ,2) }}
                                        </h4>
                                           
                                    </div>
                                    <?php } ?>


                                    <div class="clearfix"></div>
                                    </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                                             
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Transaction</th>
                                                <th>Narration</th>
                                                <th>Balance</th>
                                                <th></th>
                                                <th></th>
                  
                                            </tr>
                                        </thead>

                                        <tbody>


                                            <?php $cur_bal = 0; ?>
                                            @foreach($transactions as $transaction)
                                            <tr class="even pointer">
                                                
                                                
                                                <td class=" ">{{ $transaction->transaction_date }}</td>
                                                <td class="a-right a-right">{{ number_format($transaction->amount,2) }}</td>
                                                <td class=" ">
                                                    <?php

                                                        if($transaction->trans_type == 0){ echo 'Withdrawal'; $cur_bal = ($cur_bal - $transaction->amount); }
                                                        elseif($transaction->trans_type == 1){ echo 'Deposit'; $cur_bal = ($cur_bal + $transaction->amount); }
                                                        else{ echo 'Unknown';}
                                                        
                                                    ?>
                                                </td>
                                                <td class=" ">{{ $transaction->narration }}</td>
                                                <td class="a-right a-right ">
                                                    {{ number_format($cur_bal,2) }}
                                                
                                                </td>

                                                <td class=" ">
                                                  <a onclick="editTrans('{{ $transaction->id }}')" data-toggle="modal" class="btn btn-primary  btn-xs" href="#edittrans">
                                                    Edit Trans.
                                                  </a>
                                                </td>
                                                <td class=" last">
                                                  <a data-toggle="modal" class="btn btn-danger  btn-xs" href="">
                                                    Remove
                                                  </a>
                                                </td>
                                               

                                                                                                                            
                                            </tr>
                                            @endforeach
                                            
                                           
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                       

                    </div>
                </div>
                


        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        



<!-- Add Transaction -->

         <div id="edittrans"  class="modal fade" tabindex="-1" data-width="600">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>Edit Transaction</h4>
          </div>
                <form class="form-horizontal form-label-left" method="post"  >
       

              <div class="modal-body">
                                       
                                        
                                        

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="surname">Transaction Date
                                            </label>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="transday"  name="transday" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <?php
                                                                for($i = 1; $i < 32; $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                       
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                  <select id="transmonth"  name="transmonth" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="01">JAN</option>
                                                             <option value="02">FEB</option>
                                                             <option value="03">MAR</option>
                                                             <option value="04">APR</option>
                                                             <option value="05">MAY</option>
                                                             <option value="06">JUN</option>
                                                             <option value="07">JUL</option>
                                                             <option value="08">AUG</option>
                                                             <option value="09">SEP</option>
                                                             <option value="10">OCT</option>
                                                             <option value="11">NOV</option>
                                                             <option value="12">DEC</option>
                                                       
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                 <select id="transyear"  name="transyear" class="form-control col-md-2 col-xs-12" required>
                                                       
                                                            <?php
                                                                for($i = (date('Y') - 1); $i < (date('Y') + 2); $i++)
                                                                {
                                                                   echo  "<option value=".$i.">".$i."</option>";
                                                                }
                                                             ?>
                                                             
                                                            
                                                       
                                                </select>
                                            </div>
                                        </div>



                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Amount
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <input type="text" id="transamount" name="transamount" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Transaction Type
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                  <select id="transtype"  name="transtype" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="1">Deposit</option>
                                                             <option value="0">Withdrawal</option>              
                                                       
                                                 </select>
                                            </div>

                                            
                                        </div>




                                         <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Payment Method
                                            </label>
                                            <div class="col-md-3 col-sm-2 col-xs-12">
                                                  <select id="transpaymentmethod"  name="transpaymentmethod" class="form-control col-md-2 col-xs-12" required>
                                                                                 
                                                             <option value="Cash">Cash</option>
                                                             <option value="Cheque">Cheque</option>
                                                             <option value="Transfer">Transfer</option>
                                                             
                                                       
                                                 </select>
                                            </div>

                                            <div class="col-md-4 col-sm-7 col-xs-12">
                                                <input type="text" id="transchequeno" name="transchequeno" required="required" placeholder="Cheque/Transfer No." class="form-control col-md-7 col-xs-12">
                                            </div>

                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" >Paying Bank
                                            </label>
                                            <div class="col-md-7 col-sm-2 col-xs-12">
                                                 <select id="transbankname"  name="transbankname" class="form-control col-md-2 col-xs-12" required>
                                                      
                                                        <option value="N/A">Select bankers for cheque/transfer deposits</option>
                                                         @foreach($bankers as $bank)
                                                         <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                         @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        

                                        <div class="item form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="mobile">Narration
                                            </label>
                                            <div class="col-md-7 col-sm-7 col-xs-12">
                                                <textarea rows='3' id="transnarration" name="transnarration" required="required" class="form-control col-md-7 col-xs-12">
                                                    

                                                </textarea>
                                            </div>
                                        </div>

                                        

                                        
              </div>

              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button id="savetransaction" type="button" class="btn btn-primary">Save Transaction</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="transid" name="transid">
                <input type="hidden" id="journalid" name="journalid">
              </div>
          
        </form>
        </div>

<!-- Create new transaction-->



 <script src="{{ URL::to('js/datatables/js/jquery.dataTables.js') }}"></script>
 <script src="{{ URL::to('js/datatables/tools/js/dataTables.tableTools.js') }}"></script>



<script type="text/javascript">




 $(document).ready(function () {


        $('#savetransaction').click(function(){

          if($('#transchequeno').val() == ''){$('#transchequeno').val('N/A')}
          if(confirm("Please click OK save changes to the selected transaction."))
          {
        
                $.get('/EidtBankTransaction',
                {
                 
                        'transid': $('#transid').val(),
                        'journalid': $('#journalid').val(),
                        'transdate': $('#transyear').val()+'-'+$('#transmonth').val()+'-'+$('#transday').val(),
                        'transamount': $('#transamount').val(),
                        'transtype': $('#transtype').val(),
                        'transpaymentmethod': $('#transpaymentmethod').val(),
                        'transchequeno': $('#transchequeno').val(),
                        'transbankers': $('#transbankname').val(),
                        'transnarration': $('#transnarration').val()                      
                   
                },
                function(data)
                { 
                  
                  if(data['OK'] == 'OK'){ 

                    window.location.href = '/ViewJournal/'+$('#bankaccountno').html(); 

                    }
                  else{ alert(data['No Data']); }
                                                
                },'json');
            }

        });


    });



    

    function editTrans(id)
    {
                $.get('/GetBankTransData',
                {
                        'ID': id      
                },
                function(data)
                { 
                  
                  if(data['id'] == id)
                  { 

                    var dateVar = data['transaction_date'];
                    
                    $('#transid').val(data['id']);
                    $('#journalid').val(data['journal_id']);
                    $('#transday').val((dateVar.substring(8,10)*1));
                    $('#transmonth').val(dateVar.substring(5,7));
                    $('#transyear').val((dateVar.substring(0,4)*1));
                    $('#transbankname').val(data['bankers_id']);
                    $('#transpaymentmethod').val(data['payment_method']);
                    $('#transtype').val(data['trans_type']);
                    $('#transchequeno').val(data['cheque_no']);
                    $('#transamount').val(data['amount']);
                    $('#transnarration').text(data['narration']);

                  }
                  else{ alert(data['No Data']); }
                                                
                },'json');
    }

</script>





       <script>
           

            
            $(document).ready(function () {


                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
                ],
                    'iDisplayLength': 4,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip'
                    
                });


                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });

                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
          

        </script>














<script type="text/javascript">


function setTransAcctNo(acctno,bankers)
{
    $('#transacctno').val(acctno);
    $('#transbankers').val(bankers);
}

</script>



       



  

@stop