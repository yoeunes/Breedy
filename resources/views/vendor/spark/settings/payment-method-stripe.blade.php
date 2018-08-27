<spark-payment-method-stripe :user="user" :team="team" :billable-type="billableType" inline-template>
    <div>

        <!-- Title -->
        <div class="settings-bloc-title">
            <h2 class="title__settings">{{__('Méthode de payement')}}</h2>
        </div>



        <!-- Current Discount -->
        <el-alert v-if="currentDiscount"
                  style="max-width: 700px;"
                  title="{{__('Votre code coupon a été accepté !')}}"
                  type="success"
                  show-icon>
            <div slot>
                <span style="font-size: 14px;" v-if="currentDiscount.duration=='repeating' && currentDiscount.duration_in_months > 1">@{{ __("You currently receive a discount of :discountAmount for all invoices during the next :months months.", {discountAmount: formattedDiscount(currentDiscount), months: currentDiscount.duration_in_months}) }}</span>
                <span style="font-size: 14px;" v-if="currentDiscount.duration=='repeating' && currentDiscount.duration_in_months == 1">@{{ __("You currently receive a discount of :discountAmount for all invoices during the next month.", {discountAmount: formattedDiscount(currentDiscount)}) }}</span>
                <span style="font-size: 14px;" v-if="currentDiscount.duration=='forever'">@{{ __("You currently receive a discount of :discountAmount forever.", {discountAmount: formattedDiscount(currentDiscount)}) }}</span>
                <span style="font-size: 14px;" v-if="currentDiscount.duration=='once'">@{{ __("You currently receive a discount of :discountAmount for a single invoice.", {discountAmount: formattedDiscount(currentDiscount)}) }}</span>
            </div>
        </el-alert>


        <!-- Update VAT ID -->
        @if (Spark::collectsEuropeanVat())
            @include('spark::settings.payment-method.update-vat-id')
        @endif

        <!-- Update Card -->
        @include('spark::settings.payment-method.update-payment-method-stripe')

        <div>
            <div v-if="billable.stripe_id">
                <!-- Redeem Coupon -->
                @include('spark::settings.payment-method.redeem-coupon')
            </div>
        </div>
    </div>
</spark-payment-method-stripe>
