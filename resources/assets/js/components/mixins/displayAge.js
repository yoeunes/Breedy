export default {

    methods: {
        displayAge(birth, target) {
            let months = target.diff(birth, 'months', true)
            let birthSpan = {
                    year: Math.floor(months / 12),
                    month: Math.floor(months) % 12,
                    day: Math.round((months % 1) * target.daysInMonth(), 0)
                }
            if (birthSpan.year < 1 && birthSpan.month < 1) {
                if (birthSpan.day <= 1) {
                  return birthSpan.day + ' ' + this.$t('day')
                } else {
                  return birthSpan.day + ' ' + this.$t('days')
                }
            } else if (birthSpan.year < 1) {
                if (birthSpan.month <= 1) {
                  return birthSpan.month + ' ' + this.$t('month') + ' ' + birthSpan.day + ' ' + (birthSpan.day <= 1 ? this.$t('day') : this.$t('days'));
                } else {
                  return birthSpan.month + ' ' + this.$t('months') + ' ' + birthSpan.day + ' ' + (birthSpan.day <= 1 ? this.$t('day') : this.$t('days'));
                }
            } else if (birthSpan.year < 2) {
                if (birthSpan.year <= 1) {
                  return birthSpan.year + ' ' + this.$t('year') + ' ' + birthSpan.month + ' ' + (birthSpan.month <= 1 ? this.$t('month') : this.$t('months'));
                } else {
                  return birthSpan.year + ' ' + this.$t('years') + ' ' + birthSpan.month + ' ' + (birthSpan.month <= 1 ? this.$t('month') : this.$t('months'));
                }
            } else {
                return birthSpan.year + ' ' + (birthSpan.year <= 1 ? this.$t('year') : this.$t('years'))
            }
        }
    }
}
