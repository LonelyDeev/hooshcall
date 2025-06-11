@extends('back.layouts.master')

@section('title', 'مدیریت تماس با ما')

@section('content')
<div class="row">
    <!-- BEGIN BREADCRUMB -->
    <div class="col-md-12">
        <div class="breadcrumb-box shadow">
            <ul class="breadcrumb">
                <li><a href="{{route('back.dashboard')}}">داشبورد</a></li>
                <li><a>لیست تماس‌ها</a></li>
            </ul>
        </div>
    </div><!-- /.col-md-12 -->
    <!-- END BREADCRUMB -->

    <div class="col-lg-12">
        <div class="portlet box shadow">
            <div class="portlet-heading">
                <div class="portlet-title">
                    <h3 class="title">
                        <i class="icon-frane"></i>
                        لیست تماس‌ها
                    </h3>
                </div><!-- /.portlet-title -->
                <div class="buttons-box">
                    <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip" href="#" aria-label="{{ __('container.fullscreen') }}" data-bs-original-title="{{ __('container.fullscreen') }}">
                        <i class="icon-size-fullscreen"></i>
                        <div class="paper-ripple"><div class="paper-ripple__background"></div><div class="paper-ripple__waves"></div></div>
                    </a>
                    <a class="btn btn-sm btn-default btn-round btn-collapse" rel="tooltip" href="#" aria-label="{{ __('container.Miniaturize') }}" data-bs-original-title="{{ __('container.Miniaturize') }}">
                        <i class="icon-arrow-up"></i>
                        <div class="paper-ripple"><div class="paper-ripple__background"></div><div class="paper-ripple__waves"></div></div>
                    </a>
                </div><!-- /.buttons-box -->
            </div><!-- /.portlet-heading -->

            <div class="mb-2 datatable-actions collapse">
                <div class="d-flex align-items-center">
                    <div class="font-weight-bold text-danger mr-3"><span id="datatable-selected-rows">0</span> مورد انتخاب شده: </div>
                    <button class="btn btn-danger multiple-delete-modal" data-action="{{route('back.contacts.multipleDestroy')}}" type="button" data-bs-toggle="modal" data-bs-target="#multiple-delete-modal">حذف همه</button>
                </div>
            </div>

            <div class="portlet-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:20px"><input type="checkbox" id="btn-check-all-toggle"></th>
                                <th>نام و نام خانوادگی</th>
                                <th>شماره تماس</th>
                                <th>ایمیل</th>
                                <th>تاریخ</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($contacts))
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td><input class="item-checked" type="checkbox" value="{{$contact->id}}"></td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ jDate($contact->created_at)->format('Y/m/d H:i') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm view-details" data-id="{{ $contact->id }}">
                                                <i class="fa fa-eye"></i> جزئیات
                                            </button>
                                            <button data-bs-toggle="modal" data-bs-target="#delete-modal" data-action="{{route('back.contacts.destroy', $contact)}}" class="btn btn-danger delete-modal">
                                                <i class="fa fa-trash"></i> حذف
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="6">چیزی برای نمایش وجود ندارد</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="pagination-wrap mt-40 text-center">
                        {{ $contacts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for contact details -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">جزئیات تماس</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-content">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">نام و نام خانوادگی</th>
                                    <td id="modal-name"></td>
                                </tr>
                                <tr>
                                    <th>شماره تماس</th>
                                    <td id="modal-phone"></td>
                                </tr>
                                <tr>
                                    <th>ایمیل</th>
                                    <td id="modal-email"></td>
                                </tr>
                                <tr>
                                    <th>تاریخ ارسال</th>
                                    <td id="modal-date"></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">متن پیام</h4>
                                </div>
                                <div class="card-body">
                                    <div class="p-3 bg-light rounded" id="modal-message">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('back.partials.delete-modal', ['text_body' => 'با حذف تماس،دیگر قادر به بازیابی آن نخواهید بود'])
@include('back.partials.multiple-delete-modal', ['text_body' => 'با حذف تماس‌ها،دیگر قادر به بازیابی آنها نخواهید بود'])

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Add CSRF token to all Ajax requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle checkbox selection
    $('#btn-check-all-toggle').change(function() {
        $('.item-checked').prop('checked', $(this).prop('checked'));
        updateSelectedCount();
    });

    $('.item-checked').change(function() {
        updateSelectedCount();
    });

    function updateSelectedCount() {
        var count = $('.item-checked:checked').length;
        $('#datatable-selected-rows').text(count);
        if (count > 0) {
            $('.datatable-actions').show();
        } else {
            $('.datatable-actions').hide();
        }
    }

    // Handle multiple delete
    $('.multiple-delete-modal').click(function() {
        var ids = [];
        $('.item-checked:checked').each(function() {
            ids.push($(this).val());
        });
        $('#multiple-delete-form').attr('action', $(this).data('action'));
        $('#multiple-delete-form input[name="ids"]').val(ids.join(','));
    });

    // Handle single delete
    $('.delete-modal').click(function() {
        $('#delete-form').attr('action', $(this).data('action'));
    });

    // Handle contact details
    $('.view-details').click(function() {
        var contactId = $(this).data('id');
        var modal = $('#contactModal');
        var url = "{{ url('admin/contacts') }}/" + contactId + "/details";

        // Show loading state
        $('#modal-content').block({
            message: '',
        });

        modal.modal('show');

        // Fetch contact details
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#modal-content').unblock();
                if (response) {
                    $('#modal-name').text(response.name || '');
                    $('#modal-phone').text(response.phone || '');
                    $('#modal-email').text(response.email || '');
                    $('#modal-date').text(response.created_at || '');
                    $('#modal-message').text(response.message || '');
                } else {
                    alert('اطلاعاتی دریافت نشد');
                    modal.modal('hide');
                }
            },
            error: function(xhr, status, error) {
                $('#modal-content').unblock();
                console.error('Ajax Error:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                alert('خطا در دریافت اطلاعات');
                modal.modal('hide');
            }
        });
    });
});
</script>
@endpush