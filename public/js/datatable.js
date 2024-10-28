"use strict";

// Class definition
var DEVDatatable = (function (tableName) {
    // Define shared variables
    window[tableName + "DataTable"];
    var filterMonth;
    var filterPayment;
    window[tableName + "Table"];

    // Private functions
    var initList = function (
        tableName,
        url,
        columns,
        showActions,
        orderColumn,
        model = tableName,
        actionButtons = null
    ) {
        // Set date data order
        // const tableRows = window[tableName+'Table'].querySelectorAll("tbody tr");

        // tableRows.forEach((row) => {
        //     const dateRow = row.querySelectorAll("td");
        //     const realDate = moment(
        //         dateRow[5].innerHTML,
        //         "DD MMM YYYY, LT"
        //     ).format(); // select date from 5th column in table
        //     dateRow[5].setAttribute("data-order", realDate);
        // });

        let cols = [];
        columns.forEach(function (col, index, columns) {
            cols.push({
                data: col.data,
                name: col.name,
                orderable:
                    typeof col.orderable !== "undefined" ? col.orderable : true,
                searchable:
                    typeof col.searchable !== "undefined"
                        ? col.searchable
                        : true,
                className:
                    typeof col.className !== "undefined" ? col.className : "",
                createdCell: function (td, cellData, rowData, row, column) {
                    $(td).attr("data-label", col.label + ":");
                },
            });

            if (showActions && index === columns.length - 1) {
                cols.push({
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                    className: "text-end w-sm-1px align-middle",
                });
            }
        });

        if (showActions) {
            var exportOptionsColumns = "th:not(:last-child)";
        } else {
            var exportOptionsColumns = "";
        }

        // Function to get URL parameters as an object
        function getUrlParams() {
            const params = new URLSearchParams(window.location.search);
            const result = {};
            for (const [key, value] of params.entries()) {
                result[key] = value;
            }
            return result;
        }

        let urlParams = new URLSearchParams(window.location.search);
        let search = urlParams.get("search");

        // Initialize DataTable
        window[tableName + "DataTable"] = $(
            window[tableName + "Table"]
        ).DataTable({
            lengthMenu: [
                [25, 50, 100, 200, 300],
                [25, 50, 100, 200, 300],
            ],
            dom:
                "<'row px-5'<'col-sm-12 col-md-5 d-grid'il><'col-sm-12 col-md-7'p>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row px-5'<'col-sm-12 col-md-5 d-grid'il><'col-sm-12 col-md-7'p>>",
            pageLength: 25,
            order: orderColumn,
            processing: true,
            serverSide: true,
            // scrollX: !0,
            // select: {
            //     style: "multi",
            //     selector: "input:checkbox",
            // },
            ajax: {
                url: url,
                data: function (d) {
                    var filterData = getFormData(
                        $("#" + tableName + "-filter-form")
                    );
                    var filterTopData = getFormData(
                        $("#" + tableName + "-filter-top-form")
                    );
                    var filterButtonsData = getFormData(
                        $("#" + tableName + "-filter-button-form")
                    );
                    // var routeParams = getUrlParams(); // Get route parameters
                    // console.log(routeParams);

                    var filterAllData = {
                        ...filterData,
                        ...filterTopData,
                        ...filterButtonsData,
                        // ...routeParams, // Include route parameters in the request
                    };
                    return $.extend({}, d, filterAllData);
                },
            },
            search: {
                search: search,
            },
            columns: cols,
            // buttons: [
            //     {
            //         extend: "collection",
            //         className:
            //             "btn btn-outline-secondary dropdown-toggle me-2 hidden",
            //         text: '<i class="fa fa-file-export"></i> Export',
            //         buttons: buttons,
            //         init: function (api, node, config) {
            //             $(node).removeClass("btn-secondary");
            //             $(node).parent().removeClass("btn-group");
            //             setTimeout(function () {
            //                 $(node)
            //                     .closest(".dt-buttons")
            //                     .removeClass("btn-group")
            //                     .addClass("d-inline-flex mt-50");
            //             }, 50);
            //         },
            //     },
            // ],
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        window[tableName + "DataTable"].on("draw", function () {
            $(`#${tableName}-table`).wrap(
                "<div class='table-responsive'></div>"
            );
            initToggleToolbar(tableName);
            // handleDeleteRows();
            toggleToolbars(tableName);

            refreshFsLightbox();
            if (fsLightbox) {
                fsLightbox.props.loadOnlyCurrentSource = false;
            }

            KTMenu.createInstances();
        });

        $(document).on("change", `#select-all-${tableName}`, function (event) {
            // Get all rows with search applied
            var rows = window[tableName + "DataTable"]
                .rows({
                    search: "applied",
                })
                .nodes();
            // Check/uncheck checkboxes for all rows in the table
            $(`.${tableName}-checkboxes`, rows).prop("checked", this.checked);
        });

        $(document).on("change", `.${tableName}-checkboxes`, function (e) {
            if (
                $("." + tableName + "-checkboxes:checked").length ==
                $("." + tableName + "-checkboxes").length
            ) {
                $(`#select-all-${tableName}`).prop("checked", true);
            } else {
                $(`#select-all-${tableName}`).prop("checked", false);
            }
        });
    };

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = (tableName) => {
        document
            .querySelector(`[data-kt-${tableName}-table-filter="search"]`)
            .addEventListener("change", function (e) {
                window[tableName + "DataTable"].search(e.target.value).draw();
                let newUrl = new URL(window.location.href);
                newUrl.searchParams.set("search", e.target.value);
                window.history.pushState(
                    {
                        path: newUrl.href,
                    },
                    "",
                    newUrl.href
                );
            });
    };

    // Filter Datatable
    var handleFilterDatatable = (tableName) => {
        $(document).on("submit", `#${tableName}-filter-form`, function (event) {
            event.preventDefault();
            window[tableName + "DataTable"].ajax.reload(null, false);
            $(`#kt-${tableName}-filter-modal`).modal("hide");
            window.activateSubmitButton(this.id);
            // window[tableName + "DataTable"].search(filterString).draw();
        });

        $(document).on(
            "submit",
            `#${tableName}-filter-button-form`,
            function (event) {
                event.preventDefault();
                window[tableName + "DataTable"].ajax.reload(null, false);
            }
        );
    };

    // Delete customer
    var handleDeleteRows = (tableName, model) => {
        $(document).on(
            "click",
            `[data-${tableName}-action="delete"],[data-${tableName}-action="restore"]`,
            function (event) {
                event.preventDefault();

                var id = $(this).attr(`data-id`);
                var action = $(this).attr(`data-${tableName}-action`);

                Swal.fire({
                    text: `Are you sure you want to ${action} this ${model}?`,
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: `Yes, ${action}!`,
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn btn-primary me-3",
                        cancelButton: "btn btn-danger light",
                    },
                }).then(function (event) {
                    if (event.value) {
                        axios
                            .delete(`/dashboard/${model}/${id}`, {
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            })
                            .then(function (response) {
                                window[tableName + "DataTable"].ajax.reload(
                                    null,
                                    false
                                );

                                console.log(response);
                                Swal.fire({
                                    text: `${response.data.message}`,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton:
                                            "btn fw-bold btn-primary",
                                    },
                                });
                                // .then(function () {
                                //     i();
                                // });
                            });
                    }
                });
            }
        );
    };

    var handleDefaultRows = (tableName, model) => {
        $(document).on(
            "click",
            `[data-${tableName}-action="default"]`,
            function (event) {
                event.preventDefault();

                var id = $(this).attr(`data-id`);
                var action = $(this).attr(`data-${tableName}-action`);

                Swal.fire({
                    text: `Are you sure you want to make ${action} this ${model}?`,
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: `Yes, ${action}!`,
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn btn-primary me-3",
                        cancelButton: "btn btn-danger light",
                    },
                }).then(function (event) {
                    if (event.value) {
                        axios
                            .put(`/dashboard/${model}/${id}`, {
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                            })
                            .then(function (response) {
                                window[tableName + "DataTable"].ajax.reload(
                                    null,
                                    false
                                );

                                Swal.fire({
                                    text: `${model} has been ${response.data} Successfully!.`,
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton:
                                            "btn fw-bold btn-primary",
                                    },
                                });
                                // .then(function () {
                                //     i();
                                // });
                            });
                    }
                });
            }
        );
    };

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector(
            `[data-kt-${model}-table-filter="reset"]`
        );

        // Reset datatable
        resetButton.addEventListener("click", function () {
            // Reset month
            filterMonth.val(null).trigger("change");

            // Reset payment type
            filterPayment[0].checked = true;

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            window[tableName + "DataTable"].search("").draw();
        });
    };

    // Init toggle toolbar
    var initToggleToolbar = (tableName) => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = document
            .querySelector(`#${tableName}-table`)
            .querySelectorAll(
                `.${tableName}-checkboxes, #select-all-${tableName}`
            );

        // // Select elements
        // const deleteSelected = document.querySelector(
        //     `[data-kt-${tableName}-table-select="delete_selected"]`
        // );

        // // Toggle delete selected toolbar
        checkboxes.forEach((c) => {
            // Checkbox on click event
            c.addEventListener("click", function () {
                setTimeout(function () {
                    toggleToolbars(tableName);
                }, 50);
            });
        });

        // Deleted selected rows
        // deleteSelected.addEventListener("click", function () {
        //     // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
        //     Swal.fire({
        //         text: "Are you sure you want to delete selected customers?",
        //         icon: "warning",
        //         showCancelButton: true,
        //         buttonsStyling: false,
        //         confirmButtonText: "Yes, delete!",
        //         cancelButtonText: "No, cancel",
        //         customClass: {
        //             confirmButton: "btn fw-bold btn-danger",
        //             cancelButton: "btn fw-bold btn-active-light-primary",
        //         },
        //     }).then(function (result) {
        //         if (result.value) {
        //             Swal.fire({
        //                 text: "You have deleted all selected customers!.",
        //                 icon: "success",
        //                 buttonsStyling: false,
        //                 confirmButtonText: "Ok, got it!",
        //                 customClass: {
        //                     confirmButton: "btn fw-bold btn-primary",
        //                 },
        //             }).then(function () {
        //                 // Remove all selected customers
        //                 checkboxes.forEach((c) => {
        //                     if (c.checked) {
        //                         window[tableName+'DataTable']
        //                             .row($(c.closest("tbody tr")))
        //                             .remove()
        //                             .draw();
        //                     }
        //                 });

        //                 // Remove header checked box
        //                 const headerCheckbox =
        //                     window[tableName+'Table'].querySelectorAll('[type="checkbox"]')[0];
        //                 headerCheckbox.checked = false;
        //             });
        //         } else if (result.dismiss === "cancel") {
        //             Swal.fire({
        //                 text: "Selected customers was not deleted.",
        //                 icon: "error",
        //                 buttonsStyling: false,
        //                 confirmButtonText: "Ok, got it!",
        //                 customClass: {
        //                     confirmButton: "btn fw-bold btn-primary",
        //                 },
        //             });
        //         }
        //     });
        // });
    };

    // Toggle toolbars
    const toggleToolbars = (tableName) => {
        // Define variables
        const toolbarBase = document.querySelector(
            `[data-kt-${tableName}-table-toolbar="base"]`
        );
        const toolbarSelected = document.querySelector(
            `[data-kt-${tableName}-table-toolbar="selected"]`
        );
        const selectedCount = document.querySelector(
            `[data-kt-${tableName}-table-select="selected_count"]`
        );

        // Select refreshed checkbox DOM elements
        const allCheckboxes = document
            .querySelector(`#${tableName}-table`)
            .querySelectorAll(`.${tableName}-checkboxes`);

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach((c) => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        if (toolbarSelected) {
            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add("d-none");
                toolbarSelected.classList.remove("d-none");
            } else {
                toolbarBase.classList.remove("d-none");
                toolbarSelected.classList.add("d-none");
            }
        }
    };

    window.getFormData = ($form) => {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            if ($.trim(n["value"]).length) {
                if (indexed_array[n["name"]] !== undefined) {
                    indexed_array[n["name"]].push(n["value"]);
                } else if (
                    n["name"] !== undefined &&
                    n["name"].indexOf("[]") > -1
                ) {
                    indexed_array[n["name"]] = new Array(n["value"]);
                } else {
                    indexed_array[n["name"]] = n["value"];
                }
            }
            // indexed_array[field.name] = field.value;
        });

        return indexed_array;
    };

    // Public methods
    return {
        init: function (
            tableName,
            url,
            columns,
            showActions,
            orderColumn,
            model = tableName,
            actionButtons = null
        ) {
            window[tableName + "Table"] = document.querySelector(
                `#${tableName}-table`
            );

            if (!window[tableName + "Table"]) {
                return;
            }

            initList(
                tableName,
                url,
                columns,
                showActions,
                orderColumn,
                model,
                actionButtons
            );
            initToggleToolbar(tableName);
            handleSearchDatatable(tableName);
            handleFilterDatatable(tableName);
            handleDeleteRows(tableName, model);
            handleDefaultRows(tableName, model);
            // handleResetForm();
        },
    };
})();
