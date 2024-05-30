<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NoData from '@/Components/NoData.vue';
import Button from '@/Components/Button.vue';
import { QrCode01Icon } from '@/Components/Icons/outline';
import { ChevronRightIcon } from '@/Components/Icons/outline';
import { Lock01Icon } from '@/Components/Icons/outline';
import RobotIllustration from './Partials/RobotIllustration.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const eaModel = ref(false);

const eaModelVisible = () => {
    eaModel.value = true;
}

const closeModal = () => {
    eaModel.value = false
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="pt-3">
                <div class="flex py-2 justify-between items-center self-stretch">
                    <div class="flex flex-col justify-center items-start">
                        <div class="self-stretch text-white text-xs font-medium">Welcome back👋</div>
                        <h2 class="self-stretch text-white text-lg font-semibold">Amanda Watson</h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <Button
                            variant="transparent"
                            type="button"
                            :iconOnly="true"
                            class="border border-solid border-gray-600 bg-gray-900"
                            v-slot="{ iconSizeClasses }"
                        >
                            <QrCode01Icon />
                        </Button>
                        <div class="w-8 h-8 rounded-full overflow-hidden">
                            <img src="https://pbs.twimg.com/profile_images/1497716648240836608/0T_n2qXz_400x400.jpg" alt="profile_picture">
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <div class="flex mx-4 py-6 px-5 flex-col items-center gap-5 rounded-2xl bg-gray-700">
            <div class="flex justify-between items-center self-stretch">
                <div class="flex flex-col items-start gap-1">
                    <div class="text-gray-300 text-xs font-medium">Cash Wallet ($)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0.00</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>

                <Button
                    type="button"
                    href="/deposit"
                    class="text-sm font-semibold"
                >
                    Deposit
                </Button>
            </div>

            <div class="border-b border-solid border-gray-600 w-full"></div>

            <div class="flex items-center gap-7 self-stretch">
                <div class="flex flex-col items-start gap-1 grow">
                    <div class="text-gray-300 text-xs font-medium">Commission ($)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0.00</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>

                <div class="border-l border-solid self-stretch border-gray-600 w-1"></div>

                <div class="flex flex-col items-start gap-1 grow">
                    <div class="text-gray-300 text-xs font-medium">Refree (pax)</div>
                    <div class="flex items-center gap-5">
                        <div class="text-white text-xl font-semibold">0</div>
                        <ChevronRightIcon class="text-gray-600"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex pt-5 pb-3 px-4 flex-col items-center gap-5 relative">
            <div class="text-white">progress bar</div>

            <RobotIllustration class="absolute right-0"/>

            <div class="flex py-5 flex-col items-center gap-10 self-stretch" style="background: linear-gradient(180deg, rgba(24, 34, 48, 0.00) 0%, rgba(24, 34, 48, 0.80) 100%);">
                <div class="flex flex-col items-start gap-5 self-stretch">
                    <div class="flex flex-col items-start gap-2 self-stretch">
                        <div class="text-white text-md font-semibold">Step 1: Purchase Robotec</div>
                        <div class="self-stretch text-gray-300 text-xs">
                            Purchase Robotec to receive a unique QR code for inviting friends. Share your code, and start earning commissions with every successful referral!
                        </div>
                    </div>

                    <Button
                        size="lg"
                        class="font-semibold"
                        @click="eaModelVisible"
                    >
                        Purchase Now with $ 250.00
                    </Button>
                </div>

                <div class="flex flex-col items-start gap-5 self-stretch">
                    <div class="flex flex-col items-start gap-2 self-stretch">
                        <div class="text-white text-md font-semibold">Step 2: Set Up Your Trading Account</div>
                        <div class="self-stretch text-gray-300 text-xs">
                            Create a trading account and fund it to start auto trading and withdraw your earned commissions. Get started now to unlock your trading potential!
                        </div>
                    </div>

                    <Button
                        size="lg"
                        :disabled="true"
                        class="font-semibold"
                        v-slot="{ iconSizeClasses }"
                    >
                        <Lock01Icon class="pr-2"/>
                        Complete Step 1 to Unlock
                    </Button>
                </div>
            </div>

            <div class="flex flex-col items-center self-stretch">
                <div class="flex py-2 items-center self-stretch text-white text-xl font-semibold">Overview</div>
                <div class="flex py-2 flex-col items-center gap-3 self-stretch">
                    <div class="flex justify-between items-center self-stretch">
                        <div class="text-gray-300 text-sm font-medium">Today's PAMM Return (%)</div>
                        <div class="text-success-500 text-right text-lg font-semibold">2.19</div>
                    </div>

                    <div class="flex justify-between items-center self-stretch">
                        <div class="text-gray-300 text-sm font-medium">Cumulative PAMM Return (%)</div>
                        <div class="text-white text-right text-lg font-semibold">0</div>
                    </div>

                    <div class="flex justify-between items-center self-stretch">
                        <div class="text-gray-300 text-sm font-medium">Cumulative Earnings ($)</div>
                        <div class="text-white text-right text-lg font-semibold">0</div>
                    </div>
                </div>
            </div>
        </div>

        <Modal
            :show="eaModel"
            title="Purchase Robotec"
            @close="closeModal"
        >
            <div class="py-5">
                <div class="text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non augue vitae enim venenatis viverra vel a turpis. In et mattis quam, vitae volutpat eros. Pellentesque lectus quam, accumsan quis leo eget, faucibus pretium mauris. Donec efficitur mollis urna, at sodales felis sollicitudin sit amet. Integer nisl diam, lacinia ut malesuada eu, tincidunt quis magna. Phasellus interdum dui vitae metus facilisis, vel vulputate dui lobortis. Nam aliquet felis quis condimentum vestibulum. Proin in tincidunt justo. Cras interdum odio augue, sit amet viverra diam commodo a. Maecenas nec facilisis sem. Nunc gravida dolor eros, at eleifend lorem molestie et.

                    Morbi et malesuada felis. Phasellus at volutpat lorem. Vestibulum faucibus nulla sit amet nunc tincidunt, et lobortis magna ultrices. Vestibulum eu nulla vel quam lobortis malesuada ac ut tellus. Curabitur pharetra turpis eu tincidunt ultrices. Suspendisse sagittis quis nulla auctor vehicula. Praesent tempor pellentesque odio, in convallis justo pharetra et. Fusce massa urna, hendrerit sit amet nibh sed, sagittis maximus massa. Donec fermentum mauris sed est condimentum, id luctus eros suscipit.

                    Duis consequat nulla nisl, sed blandit odio sagittis in. Duis non viverra magna, at blandit quam. Vestibulum finibus leo purus, id eleifend elit lacinia ac. Duis maximus vehicula purus, nec venenatis felis rhoncus a. Cras et elit ut justo pellentesque interdum. Aliquam pellentesque lectus dui, vel placerat lorem iaculis mattis. Duis gravida commodo nunc. Curabitur viverra auctor placerat. Quisque id varius libero. Duis rutrum lectus erat, ac varius magna dictum sed. Suspendisse a urna quis nibh facilisis auctor. Fusce fringilla justo nec magna pretium feugiat. Nunc a ligula feugiat, vulputate sapien id, tempor mi.

                    Sed sed dolor urna. Nam sed ipsum scelerisque, maximus odio at, semper erat. Etiam eget laoreet diam. Praesent non enim posuere, vulputate libero quis, tristique urna. Pellentesque ut leo malesuada, tristique nulla at, tincidunt risus. Vivamus elit urna, placerat ut dolor vitae, lacinia efficitur libero. Maecenas ac orci a urna varius semper sit amet ut nisi. Mauris vel varius sapien. Quisque mattis fermentum felis eget bibendum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ultrices varius arcu et maximus. Integer efficitur sit amet ex sit amet consectetur. Duis tincidunt facilisis sagittis. Ut condimentum libero malesuada turpis placerat varius. Donec lobortis, libero in volutpat tincidunt, lacus diam placerat metus, vitae tincidunt nisl ligula eu elit.

                    Morbi maximus justo vitae leo venenatis, a ullamcorper eros ultricies. Nullam scelerisque interdum elit, ac pellentesque leo blandit ut. Proin interdum, eros ac pretium efficitur, mauris dolor ultricies purus, ac tempor nisi orci eget turpis. Quisque porttitor malesuada orci. Curabitur pulvinar quis elit vitae fringilla. Curabitur facilisis tortor a diam sollicitudin, vitae ultrices nunc pretium. Sed ultricies, tellus in tincidunt ultrices, ligula nunc congue nulla, sed mattis dolor dolor sit amet odio. Nulla facilisi. Proin congue, tortor a iaculis dictum, orci odio ultrices velit, sed lacinia lacus enim quis ex. Aenean vulputate, nisi vitae fermentum aliquet, tortor arcu fringilla erat, a tincidunt risus orci in dui. Suspendisse euismod convallis elit, vitae laoreet elit euismod eu. Maecenas non.
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
