(function ($) {
    var MaxAllowed = 0; // This global variable seems unused within the plugin logic as MaxAllowed is read from data-max
    $.fn.easySelect = function (options) {
        return this.each(function () {
            var settings = $.extend({
                search: false,
                buttons: false,
                placeholder: 'Select item',
                selectColor: '#414c52',
                placeholderColor: '#838383',
                itemTitle: 'Selected items',
                showEachItem: false,
                width: '100%',
                dropdownMaxHeight: 'auto',
                onItemSelected: null
            }, options);

            // Store settings in data for later access, especially for applySelectionLimit
            $(this).data('easySelectSettings', settings);

            var $this = $(this),
                numberOfOptions = $(this).children('option').length;

            $this.addClass('s-hidden');

            $this.wrap('<div class="easySelect"></div>');
            var $main = $this.closest('.easySelect').css('width', settings.width);

            $this.after('<div class="styledSelect"></div>');

            var $styledSelect = $this.next('div.styledSelect');

            $styledSelect.text(settings.placeholder).css('color', settings.placeholderColor);

            var clear = $('<span/>', {
                'class': 'clearSelectfromDiv',
                html: '&times;',
                'style': 'display: none',
            }).prependTo($main);

            var $list = $('<ul />', {
                'class': 'options'
            }).insertAfter($styledSelect);

            var $divSearch = $('<div/> ', {
                'class': 'divSearcheasySelect',
            }).appendTo($list)
            if (settings.search == false) {
                $divSearch.hide();
            }


            var $divoptions = $('<div/> ', {
                'class': 'divOptionsesySelect',
            }).appendTo($divSearch);
            if (settings.buttons == false) {
                $divoptions.hide();
            }

            var $clearSpan = $('<p />', {
                'class': 'optionRow ',
                text: 'Clear all',
                'id': 'clearAlleasySelect',
            }).appendTo($divoptions);

            var $clear = $('<span />', {
                'class': 'alleasySelect',
                html: '&times;'
            }).appendTo($clearSpan);

            var $selectAllspan = $('<p />', {
                'class': 'optionRow',
                'id': 'selectAlleasySelect',
                text: 'Select all'
            }).appendTo($divoptions);

            var $selectAll = $('<span />', {
                'class': 'alleasySelect',
                html: '&check;'
            }).appendTo($selectAllspan);

            // Adjusted to use a local variable for the message if MaxAllowed is global
            var $message = $('<p />', {
                'class': 'messageMaxallowedSelections',
                style: 'display:none',
                text: 'You can select max ' + $this.data("max") + ' items ' // Use data-max for dynamic text
            }).appendTo($divoptions);

            var $searchInput = $('<input/> ', {
                'type': 'text',
                'class': 'searchInputeasySelect',
                'placeholder': 'Search',
            }).appendTo($divSearch)

            var $maindiv = $('<div/> ', {
                'class': 'scrolableDiv',
            }).appendTo($list);
            $maindiv.css('max-height', settings.dropdownMaxHeight);

            // Adjusted to use a local variable for the message if MaxAllowed is global
            var $hiddenli = $('<li/> ', {
                text: 'You can select only ' + $this.data("max") + ' items', // Use data-max for dynamic text
                'class': 'hiddenLieasySelect',
                style: 'display: none'
            }).appendTo($list);


            for (var i = 0; i < numberOfOptions; i++) {
                var $option = $this.children('option').eq(i);
                var $li = $('<li/> ').appendTo($maindiv);

                var $label = $('<label/> ', {
                    'class': 'container',
                    text: $option.text(),
                }).appendTo($li)

                var $checkbox = $('<input> ', {
                    'class': 'mulpitply_checkbox_style',
                    'type': 'checkbox',
                    value: $option.val(),
                    // Check if the original option is selected
                    'checked': $option.is(':selected')
                }).appendTo($label)

                $('<span /> ', {
                    'class': 'checkmark',
                }).appendTo($label)
            }

            var $listItems = $list.find('li');
            var checkItem = $list.find('.mulpitply_checkbox_style');

            $styledSelect.click(function (e) {
                e.stopPropagation();
                $('div.styledSelect.active').each(function () {
                    $(this).removeClass('active').next('ul.options').hide();
                });
                $(this).toggleClass('active').next('ul.options').toggle();
            });

            function eachItem() {
                arrText = [];
                $.each($list.find('.mulpitply_checkbox_style:checked'), function () {
                    arrText.push($(this).parent().text());
                });
            }

            function eachItemoutput() {

                if (settings.showEachItem == true) {
                    $styledSelect.text(arrText.join(", ")).removeClass('active').css('color', settings.selectColor);

                } else {
                    var $checked_items = checkItem.filter(":checked").length;
                    $styledSelect.text($checked_items + ' ' + settings.itemTitle).removeClass('active').css('color', settings.selectColor);

                }
            }


            // Changed from $listItems.click to checkItem.change for more precise event handling
            checkItem.change(function (e) {
                e.stopPropagation();

                var selectedValues = [];
                $('.mulpitply_checkbox_style:checked').each(function () {
                    selectedValues.push($(this).val());
                });
                $this.closest('select').val(selectedValues); // Update the original select's value

                // Update selected attribute on original options
                $this.children('option').prop('selected', false); // Clear all first
                $.each(selectedValues, function (index, value) {
                    $this.children('option[value="' + value + '"]').prop('selected', true);
                });


                eachItem(); // Recalculate arrText
                eachItemoutput(); // Update the styled select display

                var $checked_items = checkItem.filter(":checked").length;
                if ($checked_items == 0) {
                    $styledSelect.text(settings.placeholder).removeClass('active').css('color', settings.placeholderColor);
                    clear.hide();
                } else {
                    clear.show();
                }

                // --- Call the new function here ---
                applySelectionLimit($this); // Pass the original select element

                // Call the custom callback function if provided
                if (typeof settings.onItemSelected === 'function') {
                    // Pass the original select element and the selected values
                    settings.onItemSelected.call($this[0], selectedValues);
                }
            });

            var $optionRow = $list.find('.optionRow');

            $optionRow.click(function (e) {
                e.stopPropagation();
            });
            var $clearAll = $list.find('#clearAlleasySelect');
            var $selectAll = $list.find('#selectAlleasySelect');

            /*--================================*/
            function unselectAll() {
                checkItem.prop('checked', false);
                $styledSelect.text(settings.placeholder).removeClass('active').css('color', settings.placeholderColor);
                $this.closest('select').val('');
                $this.children('option').prop('selected', false); // Ensure original select is also cleared
                $maindiv.show();
                $hiddenli.hide();
                applySelectionLimit($this); // Apply limit logic after clearing
                // Call the custom callback function if provided after unselecting all
                if (typeof settings.onItemSelected === 'function') {
                    settings.onItemSelected.call($this[0], []); // Pass an empty array for no selection
                }
            }
            $clearAll.click(function () {
                clear.hide();
                unselectAll()
            })
            clear.click(function () {
                $(this).hide();
                unselectAll()
            })
            /*--================================*/
            allValue = []; // This should probably be a local variable for each instance
            $selectAll.click(function () {
                var currentMaxAllowed = $this.data("max"); // Get the current data-max value
                if (currentMaxAllowed === "" || typeof currentMaxAllowed === typeof undefined) {
                    checkItem.prop('checked', true);
                    var selectedValuesOnSelectAll = []; // Use a new array for this specific operation
                    $('.mulpitply_checkbox_style:checked').each(function () {
                        selectedValuesOnSelectAll.push($(this).val());
                    })
                    $this.closest('select').val(selectedValuesOnSelectAll);
                    $this.children('option').prop('selected', false); // Clear all first
                    $.each(selectedValuesOnSelectAll, function (index, value) {
                        $this.children('option[value="' + value + '"]').prop('selected', true);
                    });

                    clear.show();
                    eachItem();
                    eachItemoutput();
                    // Call the custom callback function if provided after selecting all
                    if (typeof settings.onItemSelected === 'function') {
                        settings.onItemSelected.call($this[0], selectedValuesOnSelectAll);
                    }
                } else {
                    $message.css('display', 'inline-block');
                    setTimeout(function () {
                        $message.hide()
                    }, 2000);
                }
                applySelectionLimit($this); // Apply limit logic after selecting all
            })

            $(document).click(function () {
                $styledSelect.removeClass('active');
                $list.hide();
            });

            var $block = $('<li/> ', {
                'class': 'no_results',
                text: 'No results found..',
            }).appendTo($list)
            $block.hide();
            var $input = $divSearch.find('input[type="text"]');
            $input.click(function (e) {
                e.stopPropagation();
            });
            $input.keyup(function () {
                var val = $(this).val();
                var isMatch = false;
                $listItems.find('.container').each(function (i) {
                    var content = $(this).text(); // Use .text() to get visible text for search
                    if (content.toLowerCase().indexOf(val.toLowerCase()) == -1) { // Convert val to lower case for case-insensitive search
                        $(this).closest('li').hide(); // Hide the whole li, not just the container
                    } else {
                        isMatch = true;
                        $(this).closest('li').show(); // Show the whole li
                    }
                });
                $block.toggle(!isMatch);
            });

            // --- Initial state setup for default selections ---
            var initiallySelectedValues = [];
            $this.children('option:selected').each(function() {
                initiallySelectedValues.push($(this).val());
            });

            // Trigger the change event for each initially selected checkbox
            // This ensures that the styled select text, clear button, and limit are set correctly
            if (initiallySelectedValues.length > 0) {
                // Manually check the checkboxes based on initial selections
                checkItem.each(function() {
                    if ($.inArray($(this).val(), initiallySelectedValues) !== -1) {
                        $(this).prop('checked', true);
                    }
                });
                // After setting all checked properties, then update the display
                eachItem();
                eachItemoutput();
                clear.show();
                applySelectionLimit($this);
                 if (typeof settings.onItemSelected === 'function') {
                    settings.onItemSelected.call($this[0], initiallySelectedValues);
                }
            }
            // If no initial selection, ensure placeholder is shown
            else {
                $styledSelect.text(settings.placeholder).css('color', settings.placeholderColor);
                clear.hide();
            }
            // --- End of Initial state setup ---

        });
    }

    // This function should be defined globally or in an accessible scope
    function applySelectionLimit($selectElement) {
        const MaxAllowed = $selectElement.data("max"); // This correctly reads the current data-max value

        // Find the easySelect's generated elements associated with this select
        const $easySelectMain = $selectElement.closest('.easySelect');
        if ($easySelectMain.length === 0) {
            console.warn("easySelect wrapper not found for:", $selectElement.attr('id'));
            return;
        }

        const checkItem = $easySelectMain.find('.mulpitply_checkbox_style');
        const $maindiv = $easySelectMain.find('.scrolableDiv');
        const $divSearch = $easySelectMain.find('.divSearcheasySelect');
        const $hiddenli = $easySelectMain.find('.hiddenLieasySelect'); // "You can select only X items"
        const $message = $easySelectMain.find('.messageMaxallowedSelections'); // "You can select max X items" (for select all)

        const $checked_items = checkItem.filter(":checked").length;

        // Retrieve settings if available, otherwise use defaults
        const currentSettings = $selectElement.data('easySelectSettings') || {
            search: false // Default, adjust if your actual default is different
        };

        // --- Update the error message text dynamically ---
        const parsedMaxAllowed = parseInt(MaxAllowed);
        if (!isNaN(parsedMaxAllowed)) { // Ensure MaxAllowed is a valid number
            $hiddenli.text('You can select only ' + parsedMaxAllowed + ' items');
            $message.text('You can select max ' + parsedMaxAllowed + ' items');
        }
        // -------------------------------------------------

        if (MaxAllowed !== "" && MaxAllowed !== undefined && MaxAllowed !== null && $checked_items >= parsedMaxAllowed) {
            // Disable unchecked items
            checkItem.not(":checked").attr("disabled", "disabled");
            // Hide the main list and search, show the limit message
            $maindiv.hide();
            $hiddenli.show();
            if ($divSearch.length) $divSearch.hide();
        } else {
            // Enable all items
            checkItem.removeAttr("disabled");
            // Show the main list and hide the limit message
            $maindiv.show();
            $hiddenli.hide();
            // Restore search visibility based on original setting
            if (currentSettings.search === true) {
                $divSearch.show();
            } else {
                $divSearch.hide();
            }
        }
    }
}(jQuery));