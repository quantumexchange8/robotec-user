// Extra icons

import { defineComponent } from 'vue'

export const CheckCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const XCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const ExclamationCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const CheckIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const ChevronDownIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const XMarkIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const GlobeAltIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.9983 2.01367C10.7053 2.01367 9.2473 5.96367 9.0603 11.0137H14.9363C14.7493 5.96467 13.2913 2.01367 11.9983 2.01367ZM8.84229 2.51367C5.15529 3.74267 2.3793 7.11467 2.0293 11.0137H7.0603C7.1713 7.57467 7.79228 4.52467 8.84229 2.51367ZM15.1543 2.51367C16.2043 4.52467 16.8253 7.57467 16.9363 11.0137H21.9363C21.5743 7.06867 18.8773 3.76467 15.1543 2.51367ZM2.0603 13.0137C2.4203 17.0207 5.20229 20.3037 8.87329 21.5137C7.82429 19.5027 7.1713 16.4527 7.0603 13.0137H2.0603ZM9.0603 13.0137C9.2473 18.0627 10.7053 22.0137 11.9983 22.0137C13.2913 22.0137 14.7493 18.0637 14.9363 13.0137H9.0603ZM16.9363 13.0137C16.8253 16.4527 16.1723 19.5027 15.1233 21.5137C18.8943 20.2307 21.5683 16.8937 21.9363 13.0137H16.9363Z"
                    fill="currentColor"/>
            </svg>
        )
    },
})

export const Bars3BottomLeftIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd"
                      d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                      clipRule="evenodd"/>
            </svg>
        )
    },
})

export const ArrowLeftIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd"
                      d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const EmptyCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 20 20"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18Z"
                />
            </svg>
        )
    },
})

export const HomeIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
            </svg>
        )
    },
})

export const UserCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="size-6">
                <path fillRule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clipRule="evenodd" />
            </svg>
        )
    },
})

export const WhiteCheckIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M13.3332 4L5.99984 11.3333L2.6665 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const ProgressCurrentIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 35" fill="none">
                <circle cx="12" cy="23" r="4" fill="#182230"/>
                <circle cx="12" cy="23" r="6" stroke="#0A6217" stroke-opacity="0.5" stroke-width="4"/>
                <circle cx="12" cy="23" r="2" fill="#52CE39"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.31885 2.84473L10.7019 2.69936L12.5337 20.1284L12.557 20.35L12.5515 20.3562L12.5507 20.3571L12.5439 20.3641L12.5419 20.3663L12.5369 20.3712L12.5317 20.3763L12.5299 20.3781L12.5224 20.385L12.5069 20.3987L12.4991 20.4056L12.4988 20.4057L12.4908 20.4121L12.4868 20.4153L12.4824 20.4188L12.4746 20.425L12.4737 20.4255L12.4649 20.4319L12.4618 20.4343L12.4558 20.4385L12.4486 20.4436L12.4464 20.445L12.4372 20.4512L12.4351 20.4526L12.4275 20.4577L12.4213 20.4617L12.4177 20.4638L12.4075 20.47L12.4068 20.4706L12.3975 20.4762L12.3921 20.4792L12.3871 20.4822L12.377 20.488L12.3766 20.4882L12.3657 20.4941L12.3616 20.4964L12.3549 20.5001L12.3458 20.5047L12.3437 20.5058L12.3325 20.5115L12.3296 20.513L12.3211 20.5171L12.3131 20.521L12.3095 20.5228L12.2977 20.5281L12.2963 20.5289L12.2858 20.5336L12.2791 20.5365L12.2735 20.5388L12.2615 20.5441L12.2614 20.5441L12.249 20.5493L12.2436 20.5514L12.2366 20.5544L12.2256 20.5586L12.2238 20.5593L12.2109 20.5642L12.2071 20.5656L12.198 20.569L12.1883 20.5725L12.1848 20.5738L12.1715 20.5784L12.1693 20.5792L12.158 20.5828L12.1498 20.5857L12.1445 20.5873L12.1306 20.5916L12.1302 20.5919L12.1169 20.596L12.1103 20.5979L12.1028 20.6L12.0901 20.6037L12.0888 20.6041L12.0746 20.6081L12.0697 20.6095L12.0602 20.612L12.0489 20.6148L12.0458 20.6156L12.0312 20.6193L12.028 20.6201L12.0165 20.6229L12.0068 20.6251L12.0016 20.6263L11.9867 20.6296L11.9854 20.6298L11.9717 20.6329L11.9638 20.6344L11.9565 20.6359L11.942 20.6387L11.9413 20.6388L11.9258 20.6417L11.9198 20.6428L11.9106 20.6445L11.8976 20.6466L11.8949 20.6471L11.8793 20.6497L11.875 20.6503L11.8524 20.6536L11.8476 20.6543L11.8316 20.6565L11.8295 20.6567L11.8156 20.6585L11.8065 20.6595L11.7994 20.6604L11.7832 20.6621L11.7727 20.6632L11.7624 20.6642L11.7601 20.6644L11.752 20.6652L11.7415 20.6662L11.7368 20.6664L11.7312 20.6668L11.7208 20.6677L11.7138 20.6682L11.7105 20.6685L11.7001 20.669L11.6909 20.6696L11.69 20.6697L11.6797 20.6704L11.6695 20.6707L11.6681 20.6707L11.6594 20.6711L11.6493 20.6715L11.6454 20.6716L11.639 20.6717L11.6289 20.672L11.6231 20.6722L11.6189 20.6724L11.609 20.6725L11.6008 20.6726L11.5989 20.6725L11.589 20.6727L11.579 20.6725L11.5787 20.6726L11.5692 20.6724L11.5592 20.6724L11.5496 20.6722L11.5397 20.672L11.5351 20.6719L11.5301 20.6717L11.5203 20.6714L11.5134 20.6711L11.5107 20.671L11.5012 20.6706L11.492 20.6702L11.4916 20.67L11.482 20.6696L11.4724 20.6689L11.4709 20.6688L11.4631 20.6682L11.4536 20.6676L11.45 20.6673L11.4443 20.6668L11.435 20.6659L11.4292 20.6656L11.4257 20.6652L11.4164 20.6642L11.4073 20.6634L11.3981 20.6623L11.3891 20.6612L11.38 20.6601L11.3711 20.6588L11.3683 20.6587L11.3622 20.6577L11.3531 20.6565L11.3485 20.6559L11.3445 20.6553L11.3356 20.6539L11.3269 20.6525L11.3182 20.651L11.3098 20.6496L11.3097 20.6495L11.3011 20.6479L11.2925 20.6464L11.2841 20.6448L11.2756 20.643L11.2427 20.6359L11.2357 20.6343L11.2347 20.6339L11.2266 20.632L11.2186 20.63L11.2107 20.628L11.2029 20.6258L11.1951 20.6238L11.1873 20.6215L11.1496 20.263L9.31885 2.84473Z" fill="#2F1A14"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.31893 2.84472L10.7019 2.69936L10.7147 2.82148C10.5391 2.98933 10.3086 3.1026 10.0482 3.12996C9.7877 3.15735 9.53846 3.09451 9.33167 2.96676L9.31885 2.84473L9.31893 2.84472Z" fill="#170603"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0104 2.77205L9.31885 2.84473L11.1507 20.2737L11.174 20.4954L11.1808 20.5003L11.1811 20.5004L11.1882 20.5054L11.1923 20.5081L11.1956 20.5102L11.2029 20.515L11.2044 20.5158L11.2107 20.5198L11.2185 20.5243L11.2266 20.5289L11.2348 20.5335L11.2427 20.5377L11.2429 20.5378L11.2514 20.5423L11.2563 20.5446L11.2602 20.5464L11.2689 20.5507L11.2703 20.5515L11.2778 20.5547L11.2847 20.558L11.287 20.5588L11.2961 20.5627L11.2996 20.5644L11.3054 20.5667L11.3147 20.5703L11.3148 20.5705L11.3247 20.5743L11.3301 20.5764L11.3343 20.578L11.3443 20.5813L11.3461 20.582L11.3544 20.5849L11.3623 20.5875L11.3645 20.5883L11.3748 20.5916L11.3789 20.5929L11.3853 20.5948L11.3957 20.598L11.3959 20.598L11.4065 20.6011L11.4128 20.6028L11.4173 20.6041L11.4283 20.6069L11.4304 20.6075L11.4395 20.6097L11.4481 20.6119L11.4507 20.6124L11.4619 20.615L11.4664 20.6161L11.4734 20.6176L11.4847 20.62L11.4848 20.6201L11.4965 20.6225L11.5035 20.6238L11.5084 20.6247L11.5203 20.6268L11.5225 20.6272L11.5322 20.6289L11.5417 20.6305L11.5441 20.6309L11.5565 20.6328L11.5613 20.6335L11.5687 20.6345L11.581 20.6363L11.5812 20.6363L11.5935 20.638L11.601 20.6389L11.6062 20.6394L11.6189 20.6409L11.6214 20.6412L11.6316 20.6423L11.6419 20.6433L11.6444 20.6434L11.6574 20.6445L11.6626 20.6449L11.6705 20.6455L11.6836 20.6464L11.6967 20.6474L11.7047 20.6478L11.71 20.648L11.7232 20.6487L11.7261 20.6487L11.7368 20.6492L11.7478 20.6496L11.7503 20.6496L11.7639 20.6498L11.7776 20.6501L11.7913 20.6502L11.805 20.6503L11.8188 20.6502L11.8328 20.65L11.8357 20.6498L11.8468 20.6496L11.8583 20.6493L11.8609 20.6493L11.8749 20.6487L11.8808 20.6484L11.8892 20.648L11.8417 20.1956L10.0104 2.77205Z" fill="#5E4A41"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0104 2.77205L9.31885 2.84473L9.33168 2.96684C9.53846 3.09451 9.78753 3.15736 10.0479 3.13L10.0104 2.77205Z" fill="#53362B"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.79848 0.76047C10.4234 0.694872 10.9832 1.1481 11.0489 1.77304C11.1146 2.39789 10.6612 2.95778 10.0363 3.02346C9.41148 3.08913 8.85159 2.63574 8.78592 2.01089C8.72015 1.38596 9.17346 0.826163 9.79848 0.76047Z" fill="#2F1A14"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.45328 2.93074C8.87974 2.67429 8.62247 2.00166 8.87898 1.42777C9.13525 0.854172 9.80807 0.597055 10.3819 0.853474L9.45328 2.93074Z" fill="#5E4A41"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0491 1.77289C11.1148 2.39783 10.6614 2.95764 10.0365 3.02331C9.41161 3.08899 8.85189 2.63558 8.78613 2.01074C8.87087 2.81699 9.90957 2.78243 10.0055 2.77234C10.3841 2.73247 11.1261 2.50551 11.0491 1.77289Z" fill="#53362B"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.78613 2.01074C8.85182 2.63568 9.41161 3.08899 10.0366 3.02331L10.0101 2.77177C9.62981 2.81071 8.85429 2.6592 8.78613 2.01074Z" fill="#6F3E31"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.3457 3.09619C9.64457 3.18618 9.92843 3.23109 10.2095 3.20155C10.4804 3.17307 10.7676 3.10537 11.0321 2.91894L20.6293 1.91024L19.7462 5.70396L21.3988 9.23127L11.8014 10.24C11.5528 10.3829 11.2598 10.4931 10.9788 10.5226C10.6977 10.5521 10.366 10.4888 10.1152 10.4172C9.85867 7.97679 9.60218 5.53644 9.3457 3.09619Z" fill="#FFEA3F"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0574 3.2166C10.2796 3.19325 10.5145 3.1312 10.7285 2.95077L11.4946 10.24C11.2929 10.3775 11.0541 10.4816 10.8235 10.5059L10.0574 3.2166Z" fill="#DBBE00"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4335 2.24597L20.8186 1.89019L19.7454 5.70666L21.5886 9.2168L13.854 10.0297L17.4335 2.24597Z" fill="#DBBE00"/>
            </svg>
        )
    },
})

export const AlertSuccessIcon = defineComponent({
    setup() {
        return () => (
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="24" cy="24" r="24" fill="url(#paint0_linear_190_5192)"/>
                <path
                    d="M24 0C10.7676 0 0 10.7664 0 23.9972C0 37.2281 10.7676 48 24 48C37.2324 48 48 37.2336 48 24.0028C48 10.7719 37.2324 0 24 0ZM34.3411 19.4226L22.3383 32.3434C21.7955 32.9304 21.0533 33.2295 20.3056 33.2295C19.663 33.2295 19.0261 33.008 18.4999 32.5649L12.036 27.0266C10.8728 26.0298 10.7399 24.2852 11.7369 23.1222C12.7339 21.9592 14.4787 21.8207 15.6418 22.8231L20.084 26.6279L30.2756 15.6566C31.3169 14.5379 33.0672 14.4714 34.1916 15.5126C35.3159 16.5538 35.3769 18.3039 34.3411 19.4226Z"
                    fill="url(#paint1_linear_190_5192)"/>
                <defs>
                    <linearGradient id="paint0_linear_190_5192" x1="44.5968" y1="8.66785" x2="-15.2182" y2="0.397062"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0.61"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_190_5192" x1="48" y1="0" x2="14.1556" y2="39.5827"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#B2F763"/>
                        <stop offset="1" stop-color="#26AB3F"/>
                    </linearGradient>
                </defs>
            </svg>
        )
    },
})

export const AlertWarningIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <circle cx="24" cy="24" r="24" fill="url(#paint0_linear_190_5201)"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM24.0001 30.2458C25.5007 30.2458 26.7171 29.0293 26.7171 27.5287V11.52C26.7171 10.0194 25.5007 8.80297 24.0001 8.80297C22.4995 8.80297 21.2831 10.0194 21.2831 11.52V27.5287C21.2831 29.0293 22.4995 30.2458 24.0001 30.2458ZM23.9808 40.0088C22.3902 40.0088 21.1008 38.7193 21.1008 37.1288C21.1008 35.5382 22.3902 34.2488 23.9808 34.2488H24.0192C25.6098 34.2488 26.8992 35.5382 26.8992 37.1288C26.8992 38.7193 25.6098 40.0088 24.0192 40.0088H23.9808Z"
                      fill="url(#paint1_linear_190_5201)"/>
                <defs>
                    <linearGradient id="paint0_linear_190_5201" x1="44.5968" y1="8.66785" x2="-15.2182" y2="0.397062"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="white"/>
                        <stop offset="1" stop-color="white" stop-opacity="0.61"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_190_5201" x1="48" y1="0" x2="14.1556" y2="39.5827"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FCD34D"/>
                        <stop offset="1" stop-color="#D97706"/>
                    </linearGradient>
                </defs>
            </svg>
        )
    },
})
