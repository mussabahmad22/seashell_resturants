<?php
$pagename="users";
?>
@include('layouts.header')

<form action="{{route('export')}}" method="GET">
    @csrf
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto ">
            List of Seashell Users
        </h2>

        <div class="text-lg font-medium ml-8 mr-2 mb-8">
            <div class="mb-2">Start Date*</div>
            <input type="date" name="start_date" class="input w-full border flex-1" value="">
        </div>
        <div class="text-lg font-medium mr-2  mb-8 ">
            <div class="mb-2">End Date*</div>
            <input type="date" name="end_date" class="input w-full border flex-1" value="">
        </div>
        <div class="text-lg font-medium mr-2 ">
            <button class="button text-white bg-theme-42 shadow-md mr-2" type="submit"> Export Data</button>
        </div>
    </div>
</form>

<!-- <form action="{{route('export')}}" class="validate-form" method="GET">
        @csrf
        <div class="w-full sm:w-auto flex mt-2 sm:mt-0">
            <div class="mb-2">Start Date*</div>
            <input type="date" name="start_date" class="input w-full border flex-1" value="">
        </div>
        <div class="w-full sm:w-auto flex mt-3 sm:mt-0">
            <div class="mb-2">End Date*</div>
            <input type="date" name="end_date" class="input w-full border flex-1" value="">
        </div>
        <div class="w-full sm:w-auto flex mt-3 sm:mt-0">
            <button class="button text-white bg-theme-42 shadow-md mr-2" type="submit"> Export Data</button>
        </div>
    </form> -->

<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2  whitespace-no-wrap">
                    Sr.</th>

                <th class="border-b-2  whitespace-no-wrap">
                    User Name*</th>

                <th class="border-b-2  whitespace-no-wrap">
                    Phone Number*</th>

                <th class="border-b-2  whitespace-no-wrap">
                    IP Address*</th>

                <th class="border-b-2  whitespace-no-wrap">
                    Date*</th>

                <th class="border-b-2  whitespace-no-wrap">
                    Time*</th>

                <th class="border-b-2  whitespace-no-wrap">
                    Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php  $i = 0; ?>
            @foreach($query as $que)
            <?php $i++; ?>
            <tr>
                <td class="border-b w-5">{{ $i }}</td>
                <td class="border-b w-5">
                    <?= $que->name?>
                </td>
                <td class="border-b w-5">
                    <?= $que->phone?>
                </td>
                <td class="border-b w-5">
                    <?= $que->ip?>
                </td>
                <td class="border-b w-5">
                    <?= $que->date?>
                </td>
                <td class="border-b w-5">
                    <?= $que->time?>
                </td>
                <td>
                    <button style="border:none;" type="button" value="{{$que->id}}" class="deletebtn btn"><a
                            class=" flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
                            data-target="#delete-modal-preview"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                            Delete </a>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- END: Datatable -->
<div class="modal" id="delete-modal-preview">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Are you sure?</div>
            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be
                undone.
            </div>
        </div>
        <div class="px-5 pb-8 text-center">
            <form type="submit" action="{{ route('delete') }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="delete_seashell_id" id="deleting_id" value="">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="submit" class="button w-24 bg-theme-6 text-white p-3 pl-5 pr-5">Delete</button>
            </form>
        </div>
    </div>
</div>
<script>

    $(document).on('click', '.deletebtn', function () {
        var query_id = $(this).val();
        // $('#deleteModal').modal('show');
        $('#deleting_id').val(query_id);
    });
</script>
@include('layouts.footer')