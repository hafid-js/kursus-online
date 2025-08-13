 @forelse ($orders as $order)
     <tr>
         <td>{{ $loop->iteration }}</td>
         <td>
             <div class="d-flex py-1 align-items-center">
                 <span class="avatar avatar-2 me-2" style="background-image: url({{ $order->customer->image }})">
                 </span>
                 <div class="flex-fill">
                     <div class="font-weight-medium">{{ $order->customer->name }}
                     </div>
                     <div class="text-secondary"><a href="#" class="text-reset">{{ $order->customer->email }}</a>
                     </div>
                 </div>
             </div>
         </td>
         <td>{{ $order->total_amount }}</td>
         <td>{{ $order->paid_amount }}</td>
         <td>{{ $order->currency }}</td>
         <td>
             @if ($order->status == 'pending')
                 <span class="badge bg-yellow text-yellow-fg">{{ $order->status }}</span>
             @else
                 <span class="badge bg-green text-green-fg">{{ $order->status }}</span>
             @endif
         </td>
         <td>{{ format_to_date($order->created_at) }}</td>
         <td>
             <a data-order-id="{{ $order->id }}" class="btn-sm btn-primary show-order">
                 <i class="ti ti-eye"></i>
             </a>
         </td>
     </tr>
 @empty
     <tr>
         <td colspan="8" class="text-center">No Data Found!
         </td>
     </tr>
 @endforelse
