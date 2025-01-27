<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mail</title>
</head>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dcf0f8" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
  <tbody>
    <tr>
      <td align="center" valign="top" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-top:15px">
          <tbody>
            <tr style="background:#fff">
              <td align="left" width="600" height="auto" style="padding:15px"><table>
                  <tbody>
                    <tr>
                      <td>
                     
                      <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0"> Cảm ơn
                          quý khách {{ $dataArr['full_name'] }}
                          đã đặt hàng tại Chợ Đặc Sản Đà Nẵng,</h1>
                      
                        <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"> Chợ Đặc Sản Đà Nẵng thông báo đơn hàng #{{ $order_id }} của quý khách đã
                          được tiếp nhận và đang trong quá trình xử lý. Chợ Đặc Sản Đà Nẵng sẽ thông báo đến quý khách
                          ngay khi hàng chuẩn bị được giao. </p>
                        <h3 style="font-size:13px;font-weight:bold;color:#ec1c24;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd"> Thông tin đơn hàng #{{ $order_id }} <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">({{ date('d') }}/{{ date('m') }}/{{ date('Y') }} {{ date('H:i:s') }})</span> </h3></td>
                    </tr>
                    <tr>
                      <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                          <thead>
                            <tr>
                              <th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"> Thông tin thanh toán </th>
                              <th align="left" width="50%" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"> Địa chỉ giao hàng </th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <tr>
                              <td valign="top" style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                <span style="text-transform:capitalize">{!! $dataArr['full_name'] !!}</span><br>
                                <a href="mailto:{{ isset($dataArr['email']) ? $dataArr['email'] : "" }}" target="_blank">
                                  {{ isset($dataArr['email']) ? $dataArr['email'] : "" }}
                                </a><br>
                                {{ isset($dataArr['phone']) ? $dataArr['phone'] : "" }} 
                              </td>
                              <td valign="top" style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><span style="text-transform:capitalize">
                              {{ isset($dataArr['full_name']) ? $dataArr['full_name'] : "" }}</span><br>
                                <a href="mailto:{{ isset($dataArr['email']) ? $dataArr['email'] : "" }}" target="_blank">{{ isset($dataArr['email']) ? $dataArr['email'] : "" }}</a><br>
                                @if( isset( $dataArr['city_id'] ))
                                  {{ Helper::getName($dataArr['city_id'], 'city') }},
                                @endif
                                @if( isset( $dataArr['district_id'] ))
                                  {{ Helper::getName($dataArr['district_id'], 'district') }},
                                @endif
                                 @if( isset( $dataArr['ward_id'] ))
                                  {{ Helper::getName($dataArr['ward_id'], 'ward') }},
                                @endif
                                {{  $dataArr['address'] }}
                                <br>
                                ĐT: {{ $dataArr['phone'] }}<br>
                            </tr>
                            
                            <tr>
                             <td valign="top" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" colspan="2"><p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"> 
                              <strong>Phương thức thanh toán: </strong> 
                            <?php if($dataArr['method_id'] == 1) {
                              echo "Giao hàng và thu tiền tại nhà";
                            }elseif( $dataArr['method_id'] == 2){
                              echo "Chuyển khoản ngân hàng";
                            }
                              ?>
                              
                              </td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <td><p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Với những đơn hàng thanh toán trả trước, xin vui lòng đảm bảo người nhận hàng đúng thông tin đã đăng ký trong đơn hàng, và chuẩn bị giấy tờ tùy thân để đơn vị giao nhận có thể xác thực thông tin khi giao hàng.</i></p></td>
                    </tr>
                    <tr>
                      <td><h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#ec1c24"> CHI TIẾT ĐƠN HÀNG</h2>
                        <table cellspacing="0" cellpadding="0" border="0" width="100%" style="background:#f5f5f5">
                          <thead>
                            <tr>
                              <th align="left" bgcolor="#ec1c24" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                              <th align="left" bgcolor="#ec1c24" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px"> Đơn giá</th>
                              <th align="left" bgcolor="#ec1c24" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                              <th align="left" bgcolor="#ec1c24" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Giảm giá</th>
                              <th align="right" bgcolor="#ec1c24" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                            </tr>
                          </thead>
                          <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                              <?php $total = 0 ?>
                              @foreach($cart as $product_id => $product)                                
                              <tr>
                              <td align="left" valign="top" style="padding:3px 9px">
                                <span>{!! $product['name'] !!}</span>
                              </td>
                              <td align="left" valign="top" style="padding:3px 9px">
                                <span>{{ number_format($product['price']) }}&nbsp;₫</span>
                              </td>
                              <td align="left" valign="top" style="padding:3px 9px">
                                {{ number_format($product['amount']) }}
                              </td>
                              <td align="left" valign="top" style="padding:3px 9px">
                                <span>0&nbsp;₫</span>
                              </td>
                              <td align="right" valign="top" style="padding:3px 9px">
                                <span>{{ number_format($product['total_price']) }}&nbsp;₫</span>
                              </td>
                              <?php $total += $product['total_price']; ?>
                              </tr>
                              @endforeach
                          </tbody>
                          <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                            <tr>
                              <td colspan="4" align="right" style="padding:5px 9px">Tổng giá trị sản phẩm</td>
                              <td align="right" style="padding:5px 9px"><span>{{ number_format($total) }}&nbsp;₫</span></td>
                            </tr>
                            <tr>
                              <td colspan="4" align="right" style="padding:5px 9px">Giảm giá </td>
                              <td align="right" style="padding:5px 9px"><span>0&nbsp;₫</span></td>
                            </tr>
                           <!--  <tr>
                              <td colspan="4" align="right" style="padding:5px 9px">Chi phí vận chuyển</td>
                              <td align="right" style="padding:5px 9px"><span>{{ number_format($order->phi_giao_hang) }}&nbsp;₫</span></td>
                            </tr> -->
                            <tr bgcolor="#eee">
                              <td colspan="4" align="right" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big></strong></td>
                              <td align="right" style="padding:7px 9px"><strong><big><span>{{ number_format($order->tong_tien) }}&nbsp;₫</span></big></strong></td>
                            </tr>
                          </tfoot>
                        </table>                        
                    </tr>                    
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>    
  </tbody>
</table>

</body>
</html>