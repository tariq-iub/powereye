@extends('layouts.client')

@section('content')
    <div class="row gy-3 mb-6 justify-content-between align-items-center">
        <div class="col-md-4 col-12">
            <h2 class="mb-2 text-body-emphasis">Report Overview</h2>
            <h5 class="text-body-tertiary fw-semibold">Generate and download detailed reports.</h5>
        </div>
        <div class="col-md-8 col-12">
            <form action="" method="GET" class="row g-3 align-items-center">
                <div class="col">
                    <select class="form-select" id="typeSelect" name="type">
                        <option value="factory">Factories</option>
                        <option value="site">Sites</option>
                    </select>
                </div>

                <div class="col">
                    <select class="form-select" id="idSelect" name="entityId">
                        <option value="" id="first-opt">Select Factory</option>
                        @foreach($factories as $factory)
                            <option value="{{ $factory->id }}" class="type-factory">{{ $factory->title }}</option>
                        @endforeach
                        @foreach($sites as $site)
                            <option value="{{ $site->id }}" class="type-site d-none"
                                    data-factory="{{ $site->factory->title }}">
                                {{ $site->title }} - {{ $site->factory->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <div class="flatpickr-input-container">
                        <input class="form-control datetimepicker flatpickr-input ps-6" id="timepicker2" type="text"
                               placeholder="Select Date Range"
                               data-options="{&quot;mode&quot;:&quot;range&quot;,&quot;dateFormat&quot;:&quot;d/m/y&quot;,&quot;disableMobile&quot;:true}"
                               readonly="readonly"
                               name="time_range" required>
                        <span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <button class="btn btn-primary w-100 w-lg-auto" type="submit">Generate</button>
                </div>
            </form>
        </div>

        <hr class="mt-4">

        @if($reportData)
            @if($reportData->count() === 0)
                <div class="badge badge-phoenix badge-phoenix-warning">
                    No data available for the specified details.
                </div>
            @else
                <div id="reports" data-list='{"valueNames":["id", "timestamp", "avg_t", "avg_h"]}'>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="mb-2 text-body-emphasis">Generated Report</h2>
                        <a href="{{ route('reports.download', [$type, $entityId, $startDate, $endDate]) }}">
                            <button class="btn btn-success">Download PDF</button>
                        </a>
                    </div>

                    <div
                        class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
                        <div class="table-responsive scrollbar ms-n1 ps-1">
                            <table class="table table-sm fs-9 mb-0">
                                <thead>
                                <tr>
                                    <th class="sort align-middle" scope="col" data-sort="id"
                                        style="width:10%; min-width:200px;">#
                                    </th>
                                    <th class="sort align-middle" scope="col" data-sort="timestamp"
                                        style="width:30%; min-width:200px;">Timestamp
                                    </th>
                                    <th class="sort align-middle" scope="col" data-sort="avg_t"
                                        style="width:30%; min-width:200px;">Power (kW)
                                    </th>
                                    <th class="sort align-middle" scope="col" data-sort="avg_h"
                                        style="width:30%; min-width:200px;">Energy (kWh)
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($reportData as $idx => $data)
                                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                        <td class="id align-middle white-space-nowrap">{{ $idx + 1 }}</td>
                                        <td class="timestamp align-middle white-space-nowrap">{{ $data->time_bucket }}</td>
                                        <td class="avg_t align-middle white-space-nowrap">{{ $data->total_power }}</td>
                                        <td class="avg_h align-middle white-space-nowrap">{{ $data->total_energy }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="badge badge-phoenix badge-phoenix-warning">
                No reports generated yet. Please select criteria and generate a report.
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('typeSelect');
            const idSelect = document.getElementById('idSelect');
            const firstOpt = document.getElementById('first-opt');
            let selectedType = 'factory';

            const factoryOptions = document.querySelectorAll('.type-factory');
            const siteOptions = document.querySelectorAll('.type-site');

            const resetSelect = () => {
                idSelect.value = "";
            };

            typeSelect.addEventListener('change', ev => {
                let value = ev.target.value;
                if (value !== selectedType) {
                    selectedType = value;
                    resetSelect();
                }

                if (selectedType === 'factory') {
                    firstOpt.textContent = "Select Factory";
                    factoryOptions.forEach(opt => opt.classList.remove('d-none'));
                    siteOptions.forEach(opt => opt.classList.add('d-none'));
                } else {
                    firstOpt.textContent = "Select Site";
                    siteOptions.forEach(opt => opt.classList.remove('d-none'));
                    factoryOptions.forEach(opt => opt.classList.add('d-none'));
                }
            });
        });
    </script>
@endpush
