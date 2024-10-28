<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script src="{{ asset('js/datatable.js') }}"></script>

<script src="{{ asset('assets/vendor/filepond/filepond-plugin-file-validate-type.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/filepond-plugin-image-preview.js') }}"></script>
<script src="{{ asset('assets/vendor/filepond/filepond.min.js') }}"></script>
<script>
    // Register the plugin
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginImagePreview);

    // ... FilePond initialisation code here
</script>

<script src="{{ asset('assets/vendor/air-datepicker/air-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery.easyPrint/jquery.easyPrint.min.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

{{-- <script src="{{ asset('js/enable-push.js') }}" defer></script> --}}

<script>
    window.airDatepickerEnLocale = {
        days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        today: 'Today',
        clear: 'Clear',
        dateFormat: 'MM/dd/yyyy',
        timeFormat: 'hh:mm aa',
        firstDay: 0
    }
</script>


@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
            Command: toastr["error"]('{{ $error }}', 'Error!')
        </script>
    @endforeach
@endif

@if (session()->has('success'))
    <script type="text/javascript">
        Command: toastr["success"]('{{ session('success') }}', 'Success!')
    </script>
@endif

@if (session()->has('error'))
    <script type="text/javascript">
        Command: toastr["error"]('{{ session('error') }}', 'Error!')
    </script>
@endif

<script>
    window.addEventListener('successEventListener', event => {
        Command: toastr["success"](event.detail[0].message, 'Success!')
    });
    window.addEventListener('errorEventListener', event => {
        Command: toastr["error"](event.detail[0].message, 'Error!')
    });
    window.addEventListener('warningEventListener', event => {
        Command: toastr["warning"](event.detail[0].message, 'Warning!')
    });

    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('commit', ({
            component,
            succeed
        }) => {
            succeed(() => {
                var errors = component.snapshot.memo.errors;
                if (errors) {
                    for (const property in errors) {
                        Command: toastr["error"](errors[property][0], 'Error!');
                    }
                }
            })
        });
    });
</script>

<script>
    $(document).on('focus', 'input[type=number]', function() {
        $(this).select();
    });

    $(document).on('submit', 'form', function() {
        window.disableSubmitButton(this.id);
    });

    window.disableSubmitButton = function(formId) {
        $('#' + formId).find('button[type=submit]').addClass('disabled');
        $('#' + formId).find('.indicator-label').addClass('d-none');
        $('#' + formId).find('.indicator-progress').addClass('d-block');
    }

    window.activateSubmitButton = function(formId) {
        $('#' + formId).find('button[type=submit]').removeClass('disabled');
        $('#' + formId).find('.indicator-label').removeClass('d-none');
        $('#' + formId).find('.indicator-progress').removeClass('d-block');
    }
</script>

<script>
    function optionFormat(item) {
        if (!item.template) {
            return item.text;
        }

        return $(item.template);
    }

    window['select-ajax'] = function(id, value, component) {
        let attributes = document.querySelector('#' + id).attributes;
        let url = attributes['url'].value;
        let attrParams = {};
        if (typeof attributes['params'] !== typeof undefined && attributes['params'] !== false) {
            attrParams = JSON.parse(("{" + attributes['params'].value + "}").replace(/'/g, '"'));
        }

        let model = null;
        let wireModel = null;

        if (typeof attributes['wire:model.lazy'] !== typeof undefined && attributes['wire:model.lazy'] !== false) {
            model = 'lazy';
            wireModel = attributes['wire:model.lazy'].value;
        } else if (typeof attributes['wire:model'] !== typeof undefined && attributes['wire:model'] !== false) {
            model = 'defer';
            wireModel = attributes['wire:model'].value;
        }

        $(`#${id}`).select2({
                dir: $('html').attr('dir'),
                templateResult: optionFormat,
                templateSelection: optionFormat,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                            ...attrParams
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: data.to < data.total
                            }
                        };
                    },
                    cache: true
                }
            })
            .on('select2:open', (e) => {
                var selectId = e.target.id
                $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function(key, value) {
                    value.focus();
                });
            });

        if (model == 'lazy') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val());
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            window['select-ajax-set-value'](id, value, url, attrParams)
                        })
                    }
                }
            }
        }

        if (model == 'defer') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val(), false);
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            window['select-ajax-set-value'](id, value, url, attrParams)
                        })
                    }
                }
            }
        }

        if (value) {
            window['select-ajax-set-value'](id, value, url, attrParams)
        }

        $('form').on('reset', function() {
            $('#' + id).val(value).trigger('change')
        })
    }

    window['select-ajax-set-value'] = function(id, value, url, params) {
        window.axios.get(url, {
                params: {
                    value,
                    params
                }
            }).then(function(response) {
                window.loadSelectAjax = true
                let item = response.data;
                var newOption = new Option(item.text, item.id, true, true);
                $("#" + id).append(newOption).trigger('change')
                    .ready(function() {
                        $('#select2-' + id + '-container').html(item.template);
                    });
            })
            .catch(function(error) {
                console.log(error);
            })
    }

    window['select-ajax-multiple'] = function(id, value, component) {

        let attributes = document.querySelector('#' + id).attributes;
        let url = attributes['url'].value;
        let attrParams = {};
        if (typeof attributes['params'] !== typeof undefined && attributes['params'] !== false) {
            attrParams = JSON.parse(("{" + attributes['params'].value + "}").replace(/'/g, '"'));
        }

        let model = null;
        let wireModel = null;

        if (typeof attributes['wire:model.lazy'] !== typeof undefined && attributes['wire:model.lazy'] !== false) {
            model = 'lazy';
            wireModel = attributes['wire:model.lazy'].value;
        } else if (typeof attributes['wire:model'] !== typeof undefined && attributes['wire:model'] !== false) {
            model = 'defer';
            wireModel = attributes['wire:model'].value;
        }

        $(`#${id}`).select2({
            dir: $('html').attr('dir'),
            templateResult: optionFormat,
            templateSelection: optionFormat,
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        ...attrParams
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: data.to < data.total
                        }
                    };
                },
                cache: true
            }
        })

        if (model == 'lazy') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val());
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            window['select-ajax-multiple-set-value'](id, value, url, attrParams)
                        })
                    }
                }
            }
        }

        if (model == 'defer') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val(), false);
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            window['select-ajax-multiple-set-value'](id, value, url, attrParams)
                        })
                    }
                }
            }
        }

        if (typeof value !== typeof undefined && value !== false && value !== null && value.length > 0) {
            window['select-ajax-multiple-set-value'](id, value, url, attrParams)
        }

        $('form').on('reset', function() {
            $("#" + id).val(value).trigger('change')
        })
    }

    window['select-ajax-multiple-set-value'] = function(id, value, url, params) {
        window.axios.get(url, {
                params: {
                    values: value,
                    params
                }
            }).then(function(response) {
                window.loadSelectAjax = true

                $("#" + id).val([]).trigger('change');
                $('#select2-' + id + '-container').html(null);
                $('#' + id).html(null);
                response.data.forEach((item, key) => {
                    var newOption = new Option(item.text, item.id, true, true);
                    $("#" + id).append(newOption).trigger('change')
                        .ready(function() {
                            $('#select2-' + id + '-container > li:nth-child(' + (key + 1) + ') > span').html(item.template);
                        });
                });
            })
            .catch(function(error) {
                console.log(error);
            })
    }

    window['select'] = function(id, value, component) {
        let attributes = document.querySelector('#' + id).attributes;

        let model = null;
        let wireModel = null;

        if (typeof attributes['wire:model.lazy'] !== typeof undefined && attributes['wire:model.lazy'] !== false) {
            model = 'lazy';
            wireModel = attributes['wire:model.lazy'].value;
        } else if (typeof attributes['wire:model'] !== typeof undefined && attributes['wire:model'] !== false) {
            model = 'defer';
            wireModel = attributes['wire:model'].value;
        }

        $("#" + id).select2({
            dir: $('html').attr('dir'),
            templateResult: optionFormat,
            templateSelection: optionFormat,
        })

        if (model == 'lazy') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val());
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            $("#" + id).val(value).trigger('change')
                        })
                    }
                }
            }
        }

        if (model == 'defer') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val(), false);
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            $("#" + id).val(value).trigger('change')
                        })
                    }
                }
            }
        }

        $("#" + id).val(value).trigger('change')

        $('form').on('reset', function() {
            $("#" + id).val(value).trigger('change')
                .ready(function() {
                    $('#select2-' + id + '-container').html(item.template);
                });
        })
    }

    window['select-multiple'] = function(id, value, component) {
        let attributes = document.querySelector('#' + id).attributes;

        let model = null;
        let wireModel = null;

        if (typeof attributes['wire:model.lazy'] !== typeof undefined && attributes['wire:model.lazy'] !== false) {
            model = 'lazy';
            wireModel = attributes['wire:model.lazy'].value;
        } else if (typeof attributes['wire:model'] !== typeof undefined && attributes['wire:model'] !== false) {
            model = 'defer';
            wireModel = attributes['wire:model'].value;
        }

        $("#" + id).select2({
            dir: $('html').attr('dir'),
            templateResult: optionFormat,
            templateSelection: optionFormat,
        })

        if (model == 'lazy') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val());
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            $("#" + id).val(value).trigger('change')
                        })
                    }
                }
            }
        }

        if (model == 'defer') {
            if (typeof wireModel !== typeof undefined && wireModel !== false) {
                var updatedFromBack = true;
                $(document).on('select2:select select2:unselect', `#${id}`, function(e) {
                    e.preventDefault()
                    updatedFromBack = false;
                    component.set(wireModel, $(this).val(), false);
                });

                value = component.get(wireModel);

                if (updatedFromBack) {
                    updatedFromBack = true
                    if (typeof Livewire.hook !== typeof undefined && Livewire.hook !== false) {
                        component.on(wireModel + '-updated', ({
                            value
                        }) => {
                            value = component.get(wireModel);
                            $("#" + id).val(value).trigger('change')
                        })
                    }
                }
            }
        }

        $("#" + id).val(value).trigger('change')

        $('form').on('reset', function() {
            $("#" + id).val(value).trigger('change')
                .ready(function() {
                    $('#select2-' + id + '-container').html(item.template);
                });
        })
    }


    document.addEventListener('livewire:initialized', () => {
        Livewire.on('init-select2-ajax', (event) => {
            let data = event[0];
            let component = Livewire.find(data.componentId);
            let id = data.id;
            let value = data.value;

            setTimeout(() => {
                window['select-ajax'](id, value, component);
            }, 100);
        });

        Livewire.on('init-select2-ajax-multiple', (event) => {
            let data = event[0];
            let component = Livewire.find(data.componentId);
            let id = data.id;
            let value = data.value;

            setTimeout(() => {
                window['select-ajax-multiple'](id, value, component);
            }, 100);
        });

        Livewire.on('init-select2', (event) => {
            let data = event[0];
            let component = Livewire.find(data.componentId);
            let id = data.id;
            let value = data.value;

            setTimeout(() => {
                window['select'](id, value, component);
            }, 100);
        });

        Livewire.on('init-filepond', (event) => {
            setTimeout(() => {
                let data = event[0];
                let component = Livewire.find(data.componentId);
                let id = data.id;
                let name = data.name;
                let isMultiple = data.isMultiple ?? false;

                let urls = $.map(data.urls, function(elementOrValue, indexOrKey) {
                    return {
                        source: elementOrValue,
                        options: {
                            type: 'local'
                        }
                    }
                });

                let attributes = document.querySelector('#' + id).attributes;
                let files = [];
                if (urls.length > 0) {
                    files = urls.map(url => url.source);
                }

                let model = data.model;
                let wireModel = name;

                if (typeof window[id + '_filepond'] !== typeof undefined && window[id + '_filepond'] !== false) {
                    FilePond.destroy(document.querySelector("#" + id));
                }

                window[id + '_filepond'] = FilePond.create(document.querySelector("#" + id), {
                    allowReorder: true,
                    allowMultiple: isMultiple,
                    name: 'file',
                    files: urls,
                    labelButtonDownloadItem: 'custom label', // by default 'Download file'
                    allowDownloadByUrl: true, // by default downloading by URL disabled
                    server: {
                        url: '/filepond/api',
                        process: '/process',
                        revert: '/process',
                        load: (source, load, error, progress, abort, headers) => {
                            // now load it using XMLHttpRequest as a blob then load it.
                            let request = new XMLHttpRequest();
                            request.open('GET', source);
                            request.responseType = "blob";
                            request.onreadystatechange = () => request.readyState === 4 && load(request.response);
                            request.send();
                        },
                        patch: "?patch=",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    },
                });

                if (model == 'lazy') {
                    if (typeof wireModel !== typeof undefined && wireModel !== false) {
                        window[id + '_filepond'].on('processfile', (error, file) => {
                            if (error) {
                                console.log('Oh no');
                                return;
                            }

                            if (isMultiple) {
                                files.push(file.serverId);
                                component.set(wireModel, files);
                            } else {
                                component.set(wireModel, file.serverId);
                            }
                        });

                        window[id + '_filepond'].on('removefile', (error, file) => {
                            if (error) {
                                console.log('Oh no');
                                return;
                            }

                            if (isMultiple) {
                                files.splice(files.indexOf(file.serverId), 1);
                                component.set(wireModel, files);
                            } else {
                                component.set(wireModel, null);
                            }
                        });
                    }
                }

                if (model == 'defer') {
                    if (typeof wireModel !== typeof undefined && wireModel !== false) {
                        window[id + '_filepond'].on('processfile', (error, file) => {
                            if (error) {
                                console.log('Oh no');
                                return;
                            }

                            if (isMultiple) {
                                files.push(file.serverId);
                                component.set(wireModel, files, false);
                            } else {
                                component.set(wireModel, file.serverId, false);
                            }
                        });

                        window[id + '_filepond'].on('removefile', (error, file) => {
                            if (error) {
                                console.log('Oh no');
                                return;
                            }

                            if (isMultiple) {
                                files.splice(files.indexOf(file.serverId), 1);
                                component.set(wireModel, files, false);
                            } else {
                                component.set(wireModel, null, false);
                            }
                        });
                    }
                }

                window[id + '_filepond']
                    .on('addfile', (error, file) => {
                        if (isMultiple) {
                            $(`#${id} input[name='${window[id + '_filepond'].name}']`).attr('name', name + '[]');
                        } else {
                            $(`#${id} input[name='${window[id + '_filepond'].name}']`).attr('name', name);
                        }
                    });

                // window[id + '_filepond']
                //     .on('addfilestart', (e) => {
                //         $('button[type="submit"]').addClass('disabled');
                //     });

                // window[id + '_filepond']
                //     .on('processfiles', (e) => {
                //         $('button[type="submit"]').removeClass('disabled');
                //     });
            });
        }, 2000);
    });
</script>

@livewireScripts

@stack('scripts')
