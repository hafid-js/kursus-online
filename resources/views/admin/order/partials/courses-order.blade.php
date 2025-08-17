<div class="modal-header">
    <h5 class="modal-title">Invoice</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card card-lg">
            <div class="table-responsive">
                <div id="courseorders-table_wrapper" class="dt-container dt-bootstrap5">
                    <div id="courseorders-table_processing" class="dt-processing card" role="status"
                        style="display: none;">
                        <div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <table class="table table-selectable card-table table-vcenter text-nowrap datatable dataTable"
                        id="courseorders-table" style="width: 100%;">
                        <colgroup>
                            <col data-dt-column="0" style="width: 58px;">
                            <col data-dt-column="1" style="width: 135.391px;">
                            <col data-dt-column="2" style="width: 250.492px;">
                            <col data-dt-column="3" style="width: 222.945px;">
                            <col data-dt-column="4" style="width: 145.805px;">
                            <col data-dt-column="5" style="width: 134.148px;">
                            <col data-dt-column="6" style="width: 94.5469px;">
                            <col data-dt-column="7" style="width: 97.75px;">
                            <col data-dt-column="8" style="width: 166.672px;">
                            <col data-dt-column="9" style="width: 81.1328px;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th title="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Invoice&lt;/span&gt;"
                                    data-dt-column="1" rowspan="1" colspan="1"
                                    class="dt-orderable-none dt-ordering-desc" aria-sort="descending">
                                    <div class="dt-column-header"><span class="dt-column-title"><span
                                                class="d-flex justify-content-start">Invoice</span></span><span
                                            class="dt-column-order"></span></div>
                                </th>
                                <th title="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Course&lt;/span&gt;"
                                    data-dt-column="2" rowspan="1" colspan="1"
                                    class="dt-orderable-asc dt-orderable-desc">
                                    <div class="dt-column-header"><span class="dt-column-title"><span
                                                class="table-sort d-flex justify-content-start">Course</span></span><span
                                            class="dt-column-order" role="button"
                                            aria-label="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Course&lt;/span&gt;: Activate to sort"
                                            tabindex="0"></span></div>
                                </th>
                                <th title="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Student&lt;/span&gt;"
                                    data-dt-column="3" rowspan="1" colspan="1"
                                    class="dt-orderable-asc dt-orderable-desc">
                                    <div class="dt-column-header"><span class="dt-column-title"><span
                                                class="table-sort d-flex justify-content-start">Student</span></span><span
                                            class="dt-column-order" role="button"
                                            aria-label="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Student&lt;/span&gt;: Activate to sort"
                                            tabindex="0"></span></div>
                                </th>
                                <th title="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Total Amount&lt;/span&gt;"
                                    data-dt-column="4" rowspan="1" colspan="1"
                                    class="dt-orderable-asc dt-orderable-desc dt-type-numeric">
                                    <div class="dt-column-header"><span class="dt-column-title"><span
                                                class="table-sort d-flex justify-content-start">Price</span></span><span
                                            class="dt-column-order" role="button"
                                            aria-label="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Total Amount&lt;/span&gt;: Activate to sort"
                                            tabindex="0"></span></div>
                                </th>
                                <th title="Currency" data-dt-column="6" rowspan="1" colspan="1"
                                    class="dt-orderable-asc dt-orderable-desc">
                                    <div class="dt-column-header"><span class="dt-column-title">Currency</span><span
                                            class="dt-column-order" role="button"
                                            aria-label="Currency: Activate to sort" tabindex="0"></span></div>
                                </th>
                                <th title="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Status&lt;/span&gt;"
                                    data-dt-column="7" rowspan="1" colspan="1"
                                    class="dt-orderable-asc dt-orderable-desc">
                                    <div class="dt-column-header"><span class="dt-column-title"><span
                                                class="table-sort d-flex justify-content-start">Status</span></span><span
                                            class="dt-column-order" role="button"
                                            aria-label="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Status&lt;/span&gt;: Activate to sort"
                                            tabindex="0"></span></div>
                                </th>
                                <th title="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Date&lt;/span&gt;"
                                    data-dt-column="8" rowspan="1" colspan="1"
                                    class="dt-orderable-asc dt-orderable-desc">
                                    <div class="dt-column-header"><span class="dt-column-title"><span
                                                class="table-sort d-flex justify-content-start">Order Date</span></span><span
                                            class="dt-column-order" role="button"
                                            aria-label="&lt;span class=&quot;table-sort d-flex justify-content-start&quot;&gt;Date&lt;/span&gt;: Activate to sort"
                                            tabindex="0"></span></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="sorting_1">{{ $item->order->invoice_id }}</td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar avatar-2 me-2"
                                                style="background-image: url({{ $item->course->thumbnail }})"></span>
                                            <div class="flex-fill">
                                                <span>{{ $item->course->title }}</span>
                                                <div
                                                    class="font-weight-medium d-flex justify-content-between align-items-center">
                                                    <a href="#"
                                                        class="text-reset">{{ $item->course->instructor->name }}</a>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar avatar-2 me-2"
                                                style="background-image: url({{ $item->order->customer->image }})"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $item->order->customer->name }}
                                                </div>
                                                <div class="font-weight-medium">
                                                    <div class="text-secondary">
                                                        <a href="#"
                                                            class="text-reset">{{ $item->order->customer->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="dt-type-numeric">{{ $item->course->price }}</td>
                                    <td>{{ $item->order->currency }}</td>
                                    <td><span class="badge bg-lime text-lime-fg">{{ $item->order->status }}</span></td>
                                    <td>{{ format_to_date($item->order->created_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="dt-autosize" style="width: 100%; height: 0px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
