@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form elements</h4>
                            </div>
                            <div class="page-body">
                                <div class="container-xl">
                                  <div class="row row-cards">
                                    <div class="col-lg-12">
                                      <div class="card">
                                        <div class="table-responsive">
                                          <table class="table table-vcenter card-table">
                                            <thead>
                                              <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Document</th>
                                                <th>Action</th>
                                                <th class="w-1"></th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($instructorRequests as $request)
                                              <tr id="row-{{ $request->id }}">
                                                <td>{{ $request->name }}</td>
                                                <td>
                                                  {{ $request->email }}
                                                </td>
                                                <td>
                                                    @if($request->document_status === 'pending')
                                                    <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                                    @elseif ($request->document_status === 'rejected')
                                                    <span class="badge bg-red text-red-fg">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.instructor-doc-download', $request->id) }}" class="text-secondary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg></a>
                                                    <a href="{{ route('admin.instructor-doc-show', $request->id) }}" class="text-secondary"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>
                                                </td>
                                                <td>
                                                     <select name=""
                                                                            class="form-control update-approval-status"
                                                                            data-id="{{ $request->id }}">
                                                                            <option @selected($request->document_status == 'pending')
                                                                                value="pending">Pending</option>
                                                                            <option @selected($request->document_status == 'approved')
                                                                                value="approved">Approved</option>
                                                                            <option @selected($request->document_status == 'rejected')
                                                                                value="rejected">Rejected</option>
                                                                        </select>

                                                </td>
                                              </tr>
                                              @empty
                                              <tr>
                                                <td class="text-center" colspan="5">No Data Available!</td>
                                              </tr>
                                              @endforelse
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
    @vite('resources/js/admin/admin.js')
@endpush
