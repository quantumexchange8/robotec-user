// Extra icons

import { defineComponent } from 'vue'

export const CheckCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        )
    },
})

export const XCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        )
    },
})

export const ExclamationCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
        )
    },
})

export const CheckIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>
        )
    },
})

export const ChevronDownIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        )
    },
})

export const XMarkIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        )
    },
})

export const GlobeAltIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
            </svg>
        )
    },
})

export const Bars3BottomLeftIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
            </svg>
        )
    },
})

export const ArrowLeftIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        )
    },
})

export const EmptyCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M20.3149 15.4442C20.7672 14.3522 21 13.1819 21 12C21 9.61305 20.0518 7.32387 18.364 5.63604C16.6761 3.94821 14.3869 3 12 3C9.61305 3 7.32387 3.94821 5.63604 5.63604C3.94821 7.32387 3 9.61305 3 12C3 13.1819 3.23279 14.3522 3.68508 15.4442C4.13738 16.5361 4.80031 17.5282 5.63604 18.364C6.47177 19.1997 7.46392 19.8626 8.55585 20.3149C9.64778 20.7672 10.8181 21 12 21C13.1819 21 14.3522 20.7672 15.4442 20.3149C16.5361 19.8626 17.5282 19.1997 18.364 18.364C19.1997 17.5282 19.8626 16.5361 20.3149 15.4442Z"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        )
    },
})

export const HomeIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        )
    },
})

export const UserCircleIcon = defineComponent({
    setup() {
        return () => (
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        )
    },
})

export const LogOutIcon = defineComponent({
    setup() {
        return () => (
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.3333 14.1667L17.5 10M17.5 10L13.3333 5.83333M17.5 10H7.5M7.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V13.5C2.5 14.9001 2.5 15.6002 2.77248 16.135C3.01217 16.6054 3.39462 16.9878 3.86502 17.2275C4.3998 17.5 5.09987 17.5 6.5 17.5H7.5" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        )
    },
})

export const Users01Icon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M22 21V19C22 17.1362 20.7252 15.5701 19 15.126M15.5 3.29076C16.9659 3.88415 18 5.32131 18 7C18 8.67869 16.9659 10.1159 15.5 10.7092M17 21C17 19.1362 17 18.2044 16.6955 17.4693C16.2895 16.4892 15.5108 15.7105 14.5307 15.3045C13.7956 15 12.8638 15 11 15H8C6.13623 15 5.20435 15 4.46927 15.3045C3.48915 15.7105 2.71046 16.4892 2.30448 17.4693C2 18.2044 2 19.1362 2 21M13.5 7C13.5 9.20914 11.7091 11 9.5 11C7.29086 11 5.5 9.20914 5.5 7C5.5 4.79086 7.29086 3 9.5 3C11.7091 3 13.5 4.79086 13.5 7Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        )
    },
})

export const CoinsHandIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5295 8.35186C12.9571 8.75995 12.2566 9 11.5 9C9.567 9 8 7.433 8 5.5C8 3.567 9.567 2 11.5 2C12.753 2 13.8522 2.65842 14.4705 3.64814M6 20.0872H8.61029C8.95063 20.0872 9.28888 20.1277 9.61881 20.2086L12.3769 20.8789C12.9753 21.0247 13.5988 21.0388 14.2035 20.9214L17.253 20.3281C18.0585 20.1712 18.7996 19.7854 19.3803 19.2205L21.5379 17.1217C22.154 16.5234 22.154 15.5524 21.5379 14.9531C20.9832 14.4134 20.1047 14.3527 19.4771 14.8103L16.9626 16.6449C16.6025 16.9081 16.1643 17.0498 15.7137 17.0498H13.2855L14.8311 17.0498C15.7022 17.0498 16.4079 16.3633 16.4079 15.5159V15.2091C16.4079 14.5055 15.9156 13.892 15.2141 13.7219L12.8286 13.1417C12.4404 13.0476 12.0428 13 11.6431 13C10.6783 13 8.93189 13.7988 8.93189 13.7988L6 15.0249M20 6.5C20 8.433 18.433 10 16.5 10C14.567 10 13 8.433 13 6.5C13 4.567 14.567 3 16.5 3C18.433 3 20 4.567 20 6.5ZM2 14.6L2 20.4C2 20.9601 2 21.2401 2.10899 21.454C2.20487 21.6422 2.35785 21.7951 2.54601 21.891C2.75992 22 3.03995 22 3.6 22H4.4C4.96005 22 5.24008 22 5.45399 21.891C5.64215 21.7951 5.79513 21.6422 5.89101 21.454C6 21.2401 6 20.9601 6 20.4V14.6C6 14.0399 6 13.7599 5.89101 13.546C5.79513 13.3578 5.64215 13.2049 5.45399 13.109C5.24008 13 4.96005 13 4.4 13L3.6 13C3.03995 13 2.75992 13 2.54601 13.109C2.35785 13.2049 2.20487 13.3578 2.10899 13.546C2 13.7599 2 14.0399 2 14.6Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        )
    },
})

export const Speedometer04 = defineComponent({
    setup() {
        return () => (
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.7878 13.3333C15.4468 12.3884 15.8333 11.2394 15.8333 10C15.8333 9.57093 15.787 9.15268 15.6991 8.74997M5.21223 13.3333C4.55317 12.3885 4.16666 11.2394 4.16666 10C4.16666 6.77834 6.77833 4.16667 9.99999 4.16667C10.3518 4.16667 10.6963 4.19781 11.0309 4.25748M13.7499 6.25001L9.99991 10M18.3333 10C18.3333 14.6024 14.6024 18.3333 9.99999 18.3333C5.39762 18.3333 1.66666 14.6024 1.66666 10C1.66666 5.39763 5.39762 1.66667 9.99999 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10ZM10.8333 10C10.8333 10.4602 10.4602 10.8333 9.99999 10.8333C9.53975 10.8333 9.16666 10.4602 9.16666 10C9.16666 9.53977 9.53975 9.16667 9.99999 9.16667C10.4602 9.16667 10.8333 9.53977 10.8333 10Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        )
    },
})

export const CreditCardEditIcon = defineComponent({
    setup() {
        return () => (
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.66666 8.33332H18.3333V6.83332C18.3333 5.8999 18.3333 5.43319 18.1517 5.07667C17.9919 4.76307 17.7369 4.5081 17.4233 4.34831C17.0668 4.16666 16.6001 4.16666 15.6667 4.16666H4.33332C3.3999 4.16666 2.93319 4.16666 2.57667 4.34831C2.26307 4.5081 2.0081 4.76307 1.84831 5.07667C1.66666 5.43319 1.66666 5.8999 1.66666 6.83332V13.1667C1.66666 14.1001 1.66666 14.5668 1.84831 14.9233C2.0081 15.2369 2.26307 15.4919 2.57667 15.6517C2.93319 15.8333 3.3999 15.8333 4.33332 15.8333H9.16666M12.0833 17.5L13.7708 17.1625C13.9179 17.1331 13.9915 17.1184 14.0601 17.0914C14.121 17.0676 14.1789 17.0366 14.2325 16.9992C14.293 16.957 14.346 16.904 14.4521 16.7979L17.9167 13.3333C18.3769 12.8731 18.3769 12.1269 17.9167 11.6667C17.4564 11.2064 16.7102 11.2064 16.25 11.6667L12.7854 15.1312C12.6793 15.2373 12.6263 15.2904 12.5841 15.3508C12.5467 15.4044 12.5158 15.4623 12.4919 15.5232C12.465 15.5918 12.4502 15.6654 12.4208 15.8125L12.0833 17.5Z" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        )
    }
})

export const CreditCardDownloadIcon = defineComponent({
    setup() {
        return () => (
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.49999 14.1667L9.99999 16.6667M9.99999 16.6667L12.5 14.1667M9.99999 16.6667V10.8333M18.3333 7.50001H1.66666M4.58332 15H4.33332C3.3999 15 2.93319 15 2.57667 14.8184C2.26307 14.6586 2.0081 14.4036 1.84831 14.09C1.66666 13.7335 1.66666 13.2668 1.66666 12.3333V6.00001C1.66666 5.06659 1.66666 4.59988 1.84831 4.24336C2.0081 3.92976 2.26307 3.67479 2.57667 3.515C2.93319 3.33334 3.3999 3.33334 4.33332 3.33334H15.6667C16.6001 3.33334 17.0668 3.33334 17.4233 3.515C17.7369 3.67479 17.9919 3.92976 18.1517 4.24336C18.3333 4.59988 18.3333 5.06659 18.3333 6.00001V12.3333C18.3333 13.2668 18.3333 13.7335 18.1517 14.09C17.9919 14.4036 17.7369 14.6586 17.4233 14.8184C17.0668 15 16.6001 15 15.6667 15H15.4167" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        )
    }
})

export const ArrowsUpIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 20V4M7 4L3 8M7 4L11 8M17 20V9M17 9L13 13M17 9L21 13" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const ArrowsDownIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 4V15M17 15L13 11M17 15L21 11M7 4V20M7 20L3 16M7 20L11 16" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const SwitchVertical01Icon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 4V20M17 20L13 16M17 20L21 16M7 20V4M7 4L3 8M7 4L11 8" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const ChevronLeftIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const ChevronRightIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const ChevronLeftDoubleIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const ChevronRightDoubleIcon = defineComponent({
    setup() {
        return () => (
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 17L11 12L6 7M13 17L18 12L13 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const QrCode01Icon = defineComponent({
    setup() {
        return () => (
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.66667 8.00016H8V11.3335M2.00667 8.00016H2M5.34 11.3335H5.33333M8.00667 14.0002H8M14.0067 8.00016H14M2 11.3335H3M10.3333 8.00016H11.6667M2 14.0002H5.33333M8 1.3335V5.3335M11.7333 14.0002H12.9333C13.3067 14.0002 13.4934 14.0002 13.636 13.9275C13.7614 13.8636 13.8634 13.7616 13.9273 13.6362C14 13.4935 14 13.3069 14 12.9335V11.7335C14 11.3601 14 11.1734 13.9273 11.0308C13.8634 10.9054 13.7614 10.8034 13.636 10.7395C13.4934 10.6668 13.3067 10.6668 12.9333 10.6668H11.7333C11.36 10.6668 11.1733 10.6668 11.0307 10.7395C10.9052 10.8034 10.8032 10.9054 10.7393 11.0308C10.6667 11.1734 10.6667 11.3601 10.6667 11.7335V12.9335C10.6667 13.3069 10.6667 13.4935 10.7393 13.6362C10.8032 13.7616 10.9052 13.8636 11.0307 13.9275C11.1733 14.0002 11.36 14.0002 11.7333 14.0002ZM11.7333 5.3335H12.9333C13.3067 5.3335 13.4934 5.3335 13.636 5.26083C13.7614 5.19692 13.8634 5.09493 13.9273 4.96949C14 4.82688 14 4.6402 14 4.26683V3.06683C14 2.69346 14 2.50678 13.9273 2.36417C13.8634 2.23873 13.7614 2.13674 13.636 2.07283C13.4934 2.00016 13.3067 2.00016 12.9333 2.00016H11.7333C11.36 2.00016 11.1733 2.00016 11.0307 2.07283C10.9052 2.13674 10.8032 2.23873 10.7393 2.36417C10.6667 2.50678 10.6667 2.69346 10.6667 3.06683V4.26683C10.6667 4.6402 10.6667 4.82688 10.7393 4.96949C10.8032 5.09493 10.9052 5.19692 11.0307 5.26083C11.1733 5.3335 11.36 5.3335 11.7333 5.3335ZM3.06667 5.3335H4.26667C4.64004 5.3335 4.82672 5.3335 4.96933 5.26083C5.09477 5.19692 5.19676 5.09493 5.26067 4.96949C5.33333 4.82688 5.33333 4.6402 5.33333 4.26683V3.06683C5.33333 2.69346 5.33333 2.50678 5.26067 2.36417C5.19676 2.23873 5.09477 2.13674 4.96933 2.07283C4.82672 2.00016 4.64004 2.00016 4.26667 2.00016H3.06667C2.6933 2.00016 2.50661 2.00016 2.36401 2.07283C2.23856 2.13674 2.13658 2.23873 2.07266 2.36417C2 2.50678 2 2.69346 2 3.06683V4.26683C2 4.6402 2 4.82688 2.07266 4.96949C2.13658 5.09493 2.23856 5.19692 2.36401 5.26083C2.50661 5.3335 2.6933 5.3335 3.06667 5.3335Z" stroke="white" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const Lock01Icon = defineComponent({
    setup() {
        return () => (
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.1668 8.33333V6.66667C14.1668 4.36548 12.3013 2.5 10.0002 2.5C7.69898 2.5 5.8335 4.36548 5.8335 6.66667V8.33333M10.0002 12.0833V13.75M7.3335 17.5H12.6668C14.067 17.5 14.767 17.5 15.3018 17.2275C15.7722 16.9878 16.1547 16.6054 16.3943 16.135C16.6668 15.6002 16.6668 14.9001 16.6668 13.5V12.3333C16.6668 10.9332 16.6668 10.2331 16.3943 9.69836C16.1547 9.22795 15.7722 8.8455 15.3018 8.60582C14.767 8.33333 14.067 8.33333 12.6668 8.33333H7.3335C5.93336 8.33333 5.2333 8.33333 4.69852 8.60582C4.22811 8.8455 3.84566 9.22795 3.60598 9.69836C3.3335 10.2331 3.3335 10.9332 3.3335 12.3333V13.5C3.3335 14.9001 3.3335 15.6002 3.60598 16.135C3.84566 16.6054 4.22811 16.9878 4.69852 17.2275C5.2333 17.5 5.93336 17.5 7.3335 17.5Z" stroke="#334054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})

export const Copy01Icon = defineComponent({
    setup() {
        return () => (
            <svg width="20" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.6665 12.4998C3.88993 12.4998 3.50165 12.4998 3.19536 12.373C2.78698 12.2038 2.46253 11.8794 2.29337 11.471C2.1665 11.1647 2.1665 10.7764 2.1665 9.99984V4.33317C2.1665 3.39975 2.1665 2.93304 2.34816 2.57652C2.50795 2.26292 2.76292 2.00795 3.07652 1.84816C3.43304 1.6665 3.89975 1.6665 4.83317 1.6665H10.4998C11.2764 1.6665 11.6647 1.6665 11.971 1.79337C12.3794 1.96253 12.7038 2.28698 12.873 2.69536C12.9998 3.00165 12.9998 3.38993 12.9998 4.1665M10.6665 18.3332H16.1665C17.0999 18.3332 17.5666 18.3332 17.9232 18.1515C18.2368 17.9917 18.4917 17.7368 18.6515 17.4232C18.8332 17.0666 18.8332 16.5999 18.8332 15.6665V10.1665C18.8332 9.23308 18.8332 8.76637 18.6515 8.40985C18.4917 8.09625 18.2368 7.84128 17.9232 7.68149C17.5666 7.49984 17.0999 7.49984 16.1665 7.49984H10.6665C9.73308 7.49984 9.26637 7.49984 8.90985 7.68149C8.59625 7.84128 8.34128 8.09625 8.18149 8.40985C7.99984 8.76637 7.99984 9.23308 7.99984 10.1665V15.6665C7.99984 16.5999 7.99984 17.0666 8.18149 17.4232C8.34128 17.7368 8.59625 17.9917 8.90985 18.1515C9.26637 18.3332 9.73308 18.3332 10.6665 18.3332Z" stroke="#D0D5DD" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        )
    },
})