<div {{ $attributes->merge(['class' => 'card'])->whereDoesntStartWith('wire:ignore') }}>
    <div class="card-body ribbon ribbon-top ribbon-clip p-0 {{ $bodyClass }}" {{ $attributes->whereStartsWith('wire:ignore') }}>

        @isset($buttons)
            {{ $buttons }}
        @endisset

        <div class="ribbon-label p-0 mt-1">
            <x-dashboard.fields.button :id="$printId . '-print-btn'" class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Print">
                <i class="fa fa-print"></i>
            </x-dashboard.fields.button>
        </div>

        <div class="d-flex flex-column flex-xl-row">
            <div id="{{ $printId }}-print" class="flex-lg-row-fluid mb-10">
                <div class="mt-n1">
                    @isset($logo)
                        <div class="row mx-3 my-0">
                            <div class="col-12">
                                {{ $logo }}
                            </div>
                            @isset($leftTitle)
                                <div class="col-4">
                                    {{ $leftTitle }}
                                </div>
                            @endisset
                            <div class="col-8 text-end fw-bold fs-4 text-muted">
                                @isset($title)
                                    <h6 class="text-end fw-boldest text-gray-800 fs-1 my-0">{{ $title }}</h6>
                                @endisset
                                <div class="float-end my-0" style="width: fit-content;">
                                    @isset($dateTime)
                                        {{ $dateTime }}
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mx-3 my-0">
                            <div class="col-4">
                                <a href="javascript:;">
                                    @include('components.dashboard.svg.invoice-logo')
                                </a>
                            </div>

                            <div class="col-8 text-end fw-bold fs-4 text-muted">
                                @isset($title)
                                    <h6 class="text-end fw-boldest text-gray-800 fs-1 my-0">{{ $title }}</h6>
                                @endisset
                                <div class="float-end my-0" style="width: fit-content;">
                                    @isset($dateTime)
                                        {{ $dateTime }}
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @endisset
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('click', '#{{ $printId }}-print-btn', function() {
            var $elem = $('#{{ $printId }}-print');
            $elem.easyPrint({
                useIframe: true, // Whether to use iframe
                size: '', // The paper size to print on, either A4 or '4in 6in'
                direction: 'portrait', // Print direction: portrait, landscape
                className: '', // Print the outermost class attribute of the page, support customizing its style
                globalStyles: true, // Whether to include styles from the parent document
                mediaPrint: true, // When globalStyles is false, set whether to include the link tag with media='print'
                printCss: '', // Additional CSS styles for printing
                stylesheet: null, // The URL of an external style sheet to include when printing
                noPrintSelector: ".no-print",
                appendHtml: null, // Add custom HTML after (append) the selected content
                prependHtml: null, // Add custom HTML before (prepend) the selected content
                title: "{{ config('app.name') }}", // Change the printed title. By default, the page title (i.e. the <title> element) is used.
                doctype: '<!doctype html>', // Add the document type before the printed document frame
                printColor: 'exact', // Background graphics exact or economy
                printTagA: true, // Whether to print the content of label a
                groupTableHeader: true, // Group table headers, that is, whether to synchronize the headers to each page when the table cannot fit on one page.
                groupTableFooter: true, // Group table footer, that is, whether to synchronize the table footer to each page when the table cannot fit on one page.
                beforePrint: null, // Callback before printing, return iframe object, or open object
                afterPrint: null, // Printing completion callback, return time (milliseconds)
            });
        });
    </script>
@endpush
