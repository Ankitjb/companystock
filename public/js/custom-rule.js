jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
}, "The company symbol must only contain letters");

jQuery.validator.addMethod("greaterThanEqualTo",
    function (value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) >= new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val())
            || (Number(value) >= Number($(params).val()));
    }, 'Must be a date after or equal to {0}.');
