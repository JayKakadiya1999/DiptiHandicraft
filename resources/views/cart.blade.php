@extends('layout/cusmaster')
@section('body')
<?php
  use Illuminate\Support\Facades\DB;
?>
@if($data != null)
<section class="cart_area">
      <div class="container">
      <div class="row">
      <h4 style="color:red;margin-bottom:25px;">Note : Payment is accept in cash on delivery mode.</h4>
      </div> 
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Product</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Discount</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $row)
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src="{{ $row->Path }}" alt="" style="width: 100px">
                                      </div>
                                      <div class="media-body">
                                          <p>{{ $row->Product_name }}</p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5>₹{{ $row->Price }}</h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="text" name="qty" value="{{  $row->qty}}" title="Quantity:"
                                          class="input-text qty">
                                      <form action="{{ route('increment') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="text" name="id" value="{{ $row->Product_id }}" style="display: none;">
                                        <button class="increase items-count" type="submit"><i class="lnr lnr-chevron-up"></i></button>
                                      </form>
                                      <form action="{{ route('decrement') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="text" name="id" value="{{ $row->Product_id }}" style="display: none;">
                                        <button class="reduced items-count" type="submit"><i class="lnr lnr-chevron-down"></i></button>
                                      </form>
                                  </div>
                              </td>
                              <td>
                                  <h5>₹
                                    <?php
                                        $discount = $row->Discount * $row->qty;
                                        echo $discount;
                                    ?>
                                  </h5>
                              </td>
                              <td>
                                  <h5><?php
                                      $prototal = $row->Price * $row->qty - $row->Discount * $row->qty;
                                      echo $prototal;
                                  ?></h5>
                                  
                              </td>
                          </tr>
                          @endforeach
                          
                            <tr class="bottom_button">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>
                                  <h5>SGST</h5>
                              </td>
                              <td>
                                  <h5><?php
                                      
                                      $sgst = $total * 2.5 /100;
                                      echo $sgst;
                                  ?></h5>
                              </td>
                            </tr>

                            <tr class="bottom_button">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>
                                  <h5>CGST</h5>
                              </td>
                              <td>
                                  <h5><?php
                                      $cgst = $total* 2.5 /100;
                                      echo $cgst;
                                  ?>
                                  </h5>
                              </td>
                            </tr>
                          <tr class="bottom_button">
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>
                                  <h5>Subtotal</h5>
                              </td>
                              <td>
                                  <h5><?php
                                      $total = $total + $cgst + $sgst;
                                      echo $total;
                                  ?>
                                  </h5>
                              </td>
                            </tr>
                            
                      </tbody>
                  </table>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-9">
                      </div>
                      <div class="col-lg-3" style="text-align: right;">
                        <a class="button primary-btn" href="placeorder">Order Now</a>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  @endif

  @if($data == null)
  <br><br>
  <h1 style="color: red;text-align: center">Oops..!! Your Cart Is Empty.</h1>
  <br><br>
  @endif

@endsection('body')