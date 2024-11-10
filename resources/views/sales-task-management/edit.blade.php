@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Task Name</label>
                                <input type="text" class="form-control" value="{{ $sales_task->task_name }}" name="task_name" placeholder="Ex:....">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Due Date</label>
                                <input type="date" class="form-control" value="{{ $sales_task->due_date }}" name="due_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->
    
                        <div class="col-md-4 mb-4">
                            <label class="col-md-2 col-form-label">Priority</label>
                            <select class="form-select" name="priority">
                                <option value="low" {{ $sales_task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $sales_task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ $sales_task->priority == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="col-md-2 col-form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="pending" {{ $sales_task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in progress" {{ $sales_task->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $sales_task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="overdue" {{ $sales_task->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label></label>
                            <select class="form-select" id="employee_id" name="employee_id">
                                <option value="">Select Employee</option>
                                @foreach ($employes as $employee)
                                    <option value="{{ $employee->id }}" {{ $sales_task->assigned_employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->first_name }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" placeholder="Ex: Jakarta" name="description" rows="3">{{ $sales_task->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" id="remarks" placeholder="Ex: Jakarta" name="remarks" rows="3">{{ $sales_task->remarks }}</textarea>
                            </div>
                        </div>
    
                       
                    </div><!-- end row -->
                    <a href="{{ route('sales-task-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous validation messages
                const errorElements = document.querySelectorAll('.error-msg');
                errorElements.forEach(function(element) {
                    element.remove();
                });

                let isValid = true;

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('sales-task-update',$sales_task->id) }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alertSuccess(response.msg);
                                window.location.href = '{{ route('sales-task-list') }}';
                            } else {
                                alertFailed(response.msg);
                            }
                        },
                        error: function(xhr) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    showError(errors[key][0], `[name="${key}"]`);
                                }
                            }
                        }
                    });
                }
            });

            function showError(message, selector) {
                const element = document.querySelector(selector);
                const error = document.createElement('span');
                error.className = 'error-msg text-danger';
                error.textContent = message;
                element.parentNode.appendChild(error);
            }
        });
    </script>
@endsection
