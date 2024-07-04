import SimpleMaskMoney from "simple-mask-money";

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.mask-money').forEach((el) => {
            let optionsBRL = {
                // afterFormat(e) {
                //   console.log('afterFormat', e)
                // },
                allowNegative: false,
                // beforeFormat(e) {
                //   console.log('beforeFormat', e)
                // },
                negativeSignAfter: false,
                prefix: 'R$ ',
                suffix: '',
                fixed: true,
                fractionDigits: 2,
                decimalSeparator: ',',
                thousandsSeparator: '.',
                cursor: 'end'
            }

            SimpleMaskMoney.setMask(el, optionsBRL)

        }
    )
})
