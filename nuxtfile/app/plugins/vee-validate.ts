import { defineRule, configure } from 'vee-validate'
import { required, email, min, max } from '@vee-validate/rules'
import { localize, setLocale } from '@vee-validate/i18n'

export default defineNuxtPlugin(() => {
    defineRule('required', required)
    defineRule('email', email)
    defineRule('min', min)
    defineRule('max', max)

    configure({
        generateMessage: (ctx) => {
            const field = ctx.field;
            const params = ctx.rule?.params;
            let length = '';

            if (Array.isArray(params) && params.length > 0) {
                length = params[0];
            } else if (params && typeof params === 'object') {
                length = params.min || params.max || params.length || Object.values(params)[0];
            }

            switch (ctx.rule?.name) {
                case 'required':
                    return `${field}は必須項目です`;
                case 'email':
                    return '正しいメールアドレスの形式で入力してください';
                case 'min':
                    return `${field}は${length}文字以上で入力してください`;
                case 'max':
                    return `${field}は${length}文字以内で入力してください`;
                default:
                    return `${field}の入力内容が正しくありません`;
            }
        }
    })

    setLocale('ja')
})