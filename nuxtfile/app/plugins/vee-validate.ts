import { defineRule, configure } from 'vee-validate'
import { required, email, min, max } from '@vee-validate/rules'
import { localize, setLocale } from '@vee-validate/i18n'
import ja from '@vee-validate/i18n/dist/locale/ja.json'

export default defineNuxtPlugin(() => {
    defineRule('required', required)
    defineRule('email', email)
    defineRule('min', min)
    defineRule('max', max)

    configure({
        generateMessage: localize({
            ja: {
                messages: {
                    ...ja.messages,
                    required: '{field}は必須項目です',
                    email: '正しいメールアドレスの形式で入力してください',
                    min: '{field}は{length}文字以上で入力してください',
                    max: '{field}は{length}文字以内で入力してください',
                },
            },
        }),
    })

    setLocale('ja')
})