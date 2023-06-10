<x-layout>
    <x-header favorites="{{ $favorites }}" numberOfCartItems="{{ $numberOfCartItems }}"/>
    <x-setting heading="Add New Coupon">
        <form method="POST" action="{{ route('admin.coupons') }}">
            @csrf

            <p class="text-sm">All fields marked with * are required</p>

            <x-form.input name="name" type="text">*</x-form.input>
            <x-form.input name="code" type="text">*</x-form.input>
            <div>
                <x-form.input-label for="type">Choose a type</x-form.input-label>
                <input id="fixed" type="radio" name="type" value="fixed" checked onclick="showHideInput()"/> Fixed
                <input id="percent" type="radio" name="type" value="percent_off" onclick="showHideInput()"/> Percent
            </div>
            <x-form.input name="value" type="number" label="Discount in dollars" min="0">*</x-form.input>
            <x-form.input name="percent_off" type="number" label="Discount in percent" min="0">*</x-form.input>
            <x-form.input name="valid_from" type="date" label="Valid From">*</x-form.input>
            <x-form.input name="valid_until" type="date" label="Valid Until">*</x-form.input>


            <x-primary-button class="mt-4">Add</x-primary-button>
        </form>
    </x-setting>

    <x-footer/>
    <script>
        let fixed = document.getElementById("fixed");
        let percent = document.getElementById("percent");
        let fixedValue = document.getElementsByClassName("value");
        let percentValue = document.getElementsByClassName("percent_off");

        function showHideInput() {
            if(fixed.checked)
            {
                percentValue[1].value = null;

                Array.prototype.forEach.call(fixedValue, function(x) {
                   x.style.display = "block"
                });

                Array.prototype.forEach.call(percentValue, function(x) {
                    x.style.display = "none"
                });
            } else {
                fixedValue[1].value = null;

                Array.prototype.forEach.call(fixedValue, function(x) {
                    x.style.display = "none"
                });

                Array.prototype.forEach.call(percentValue, function(x) {
                    x.style.display = "block"
                });
            }
        }

        showHideInput()
    </script>
</x-layout>

