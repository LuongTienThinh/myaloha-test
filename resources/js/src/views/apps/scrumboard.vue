<template>
    <div>
        <div>
            <button type="button" class="btn btn-primary flex" @click="addEditProject()">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24px"
                    height="24px"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="w-5 h-5 ltr:mr-3 rtl:ml-3"
                >
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add Project
            </button>
        </div>

        <!-- project list -->
        <div class="relative pt-5">
            <div class="h-full -mx-2">
                <div class="overflow-x-auto flex items-start flex-nowrap gap-5 px-2 pb-2">
                    <template v-for="project in projectList" :key="project.id">
                        <div class="panel w-80 flex-none">
                            <div class="flex justify-between mb-5">
                                <h4 class="text-base font-semibold">{{ project.title }}</h4>

                                <div class="flex items-center">
                                    <button type="button" class="hover:text-primary ltr:mr-2 rtl:ml-2" @click="addEditTask(project.id)">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                            <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            />
                                        </svg>
                                    </button>
                                    <div class="dropdown">
                                        <Popper :placement="store.rtlClass === 'rtl' ? 'bottom-start' : 'bottom-end'" offsetDistance="0">
                                            <button type="button" class="hover:text-primary">
                                                <svg
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5 opacity-70 hover:opacity-100"
                                                >
                                                    <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                                    <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5"></circle>
                                                </svg>
                                            </button>
                                            <template #content="{ close }">
                                                <ul @click="close()" class="text-black dark:text-white-dark whitespace-nowrap">
                                                    <li>
                                                        <a href="javascript:;" @click="addEditProject(project)">Edit </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" @click="deleteProject(project)">Delete </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" @click="clearProjects(project)">Clear All </a>
                                                    </li>
                                                </ul>
                                            </template>
                                        </Popper>
                                    </div>
                                </div>
                            </div>

                            <!-- task list -->
                            <draggable
                                v-model="project.tasks"
                                class="connect-sorting-content min-h-[150px]"
                                group="default"
                                ghost-class="sortable-ghost"
                                drag-class="sortable-drag"
                                :animation="200"
                                @change="onDraggableChange(project.id, $event)"
                            >
                                <div class="sortable-list" v-for="task in project.tasks" :key="project.id + '' + task.id">
                                    <div class="shadow bg-[#f4f4f4] dark:bg-white-dark/20 p-3 pb-5 rounded-md mb-5 space-y-3 cursor-move">
                                        <template v-if="task.image">
                                            <img src="/assets/images/carousel1.jpeg" alt="images" class="h-32 w-full object-cover rounded-md" />
                                        </template>
                                        <div class="text-base font-medium">{{ task.title }}</div>
                                        <p class="break-all">{{ task.description }}</p>
                                        <div class="flex gap-2 items-center flex-wrap">
                                            <template v-if="task.tags?.length">
                                                <template v-for="(tag, i) in task.tags" :key="i">
                                                    <div class="btn px-2 py-1 flex btn-outline-primary">
                                                        <svg
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="w-5 h-5 shrink-0"
                                                        >
                                                            <path
                                                                d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.59881 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z"
                                                                stroke="currentColor"
                                                                stroke-width="1.5"
                                                            />
                                                            <circle
                                                                opacity="0.5"
                                                                cx="8.60699"
                                                                cy="8.87891"
                                                                r="2"
                                                                transform="rotate(-45 8.60699 8.87891)"
                                                                stroke="currentColor"
                                                                stroke-width="1.5"
                                                            />
                                                            <path
                                                                opacity="0.5"
                                                                d="M11.5417 18.5L18.5208 11.5208"
                                                                stroke="currentColor"
                                                                stroke-width="1.5"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>

                                                        <span class="ltr:ml-2 rtl:mr-2">{{ tag }}</span>
                                                    </div>
                                                </template>
                                            </template>
                                            <template v-else>
                                                <div class="btn px-2 py-1 flex text-white-dark dark:border-white-dark/50 shadow-none">
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 shrink-0"
                                                    >
                                                        <path
                                                            d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.59881 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        />
                                                        <circle
                                                            opacity="0.5"
                                                            cx="8.60699"
                                                            cy="8.87891"
                                                            r="2"
                                                            transform="rotate(-45 8.60699 8.87891)"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        />
                                                        <path
                                                            opacity="0.5"
                                                            d="M11.5417 18.5L18.5208 11.5208"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        />
                                                    </svg>
                                                    <span class="ltr:ml-2 rtl:mr-2">No Tags</span>
                                                </div>
                                            </template>
                                        </div>
                                        <div class="font-bold" v-if="task.user_id">Asignee: {{ task.user_name }}</div>
                                        <div class="flex items-center justify-between">
                                            <div class="font-medium flex items-center hover:text-primary">
                                                <svg
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5 ltr:mr-3 rtl:ml-3 shrink-0"
                                                >
                                                    <path
                                                        d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z"
                                                        stroke="currentColor"
                                                        stroke-width="1.5"
                                                    />
                                                    <path opacity="0.5" d="M7 4V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M17 4V2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path opacity="0.5" d="M2 9H22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                </svg>
                                                <span :class="classExpireTime(task.date_end)">{{ formatDatetime(task.date_end) }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <button type="button" class="hover:text-info" @click="addEditTask(project.id, task)">
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 ltr:mr-3 rtl:ml-3"
                                                    >
                                                        <path
                                                            opacity="0.5"
                                                            d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        />
                                                        <path
                                                            d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        />
                                                        <path
                                                            opacity="0.5"
                                                            d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                        />
                                                    </svg>
                                                </button>
                                                <button type="button" class="hover:text-danger" @click="deleteConfirmModal(project.id, task)">
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5"
                                                    >
                                                        <path
                                                            opacity="0.5"
                                                            d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        ></path>
                                                        <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                        <path
                                                            d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        ></path>
                                                        <path
                                                            opacity="0.5"
                                                            d="M9.5 11L10 16"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        ></path>
                                                        <path
                                                            opacity="0.5"
                                                            d="M14.5 11L14 16"
                                                            stroke="currentColor"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                        ></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </draggable>

                            <div class="pt-3">
                                <button type="button" class="btn btn-primary mx-auto" @click="addEditTask(project.id)">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="w-5 h-5"
                                    >
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Add Task
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- add project modal -->
        <TransitionRoot appear :show="isAddProjectModal" as="template">
            <Dialog as="div" @close="isAddProjectModal = false" class="relative z-[51]">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center px-4 py-8">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                <button
                                    type="button"
                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                    @click="isAddProjectModal = false"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="w-6 h-6"
                                    >
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                    {{ params.id ? 'Edit Project' : 'Add Project' }}
                                </div>
                                <div class="p-5">
                                    <form @submit.prevent="saveProject">
                                        <div class="grid gap-5">
                                            <div>
                                                <label for="title">Name</label>
                                                <input id="title" v-model="params.title" type="text" class="form-input mt-1" placeholder="Enter Name" />
                                            </div>
                                        </div>

                                        <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-outline-danger" @click="isAddProjectModal = false">Cancel</button>
                                            <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">{{ params.id ? 'Update' : 'Add' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- add task modal -->
        <TransitionRoot appear :show="isAddTaskModal" as="template">
            <Dialog as="div" @close="isAddTaskModal = false" class="relative z-[51]">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center px-4 py-8">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                <button
                                    type="button"
                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                    @click="isAddTaskModal = false"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="w-6 h-6"
                                    >
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                    {{ paramsTask.id ? 'Edit Task' : 'Add Task' }}
                                </div>
                                <div class="p-5">
                                    <form @submit.prevent="saveTask">
                                        <div class="grid gap-5">
                                            <div>
                                                <label for="taskTitle">Name</label>
                                                <input id="taskTitle" v-model="paramsTask.title" type="text" class="form-input" placeholder="Enter Name" />
                                            </div>

                                            <div>
                                                <label for="taskTag">Tag</label>
                                                <input id="taskTag" v-model="paramsTask.tags" type="text" class="form-input" placeholder="Enter Tag" />
                                            </div>
                                            <div>
                                                <label for="taskdesc">Description</label>
                                                <textarea
                                                    id="taskdesc"
                                                    v-model="paramsTask.description"
                                                    class="form-textarea min-h-[130px]"
                                                    placeholder="Enter Description"
                                                ></textarea>
                                            </div>
                                            <div>
                                                <label for="assignee">Assignee</label>
                                                <div class="relative w-full flex">
                                                    <input 
                                                        type="text"
                                                        v-model="paramsTask.user_name"
                                                        placeholder="Assign for" 
                                                        class="form-input rounded-none bg-white  dark:shadow-[#1b2e4b] placeholder:tracking-wider focus:outline-none py-2"
                                                        @focus="isShowListUser = true"
                                                        @blur="handleBlur()"
                                                    />
                                                    <div v-if="isShowListUser" class="absolute top-[calc(100%+1px)] left-0 w-full border-[1px] bg-white p-2 shadow-sm overflow-y-scroll max-h-48">
                                                        <ul class="space-y-1">
                                                            <li v-for="user in userList" :key="user.id" class="px-2 py-1 cursor-pointer hover:bg-cyan-500 hover:text-white" @click="handleAssignForUser(user)">
                                                                {{ user.name }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="dateStart">Date Start</label>
                                                <input
                                                    id="dateStart"
                                                    v-model="paramsTask.date_start"
                                                    type="datetime-local"
                                                    class="form-input"
                                                    placeholder="Event Start Date"
                                                />
                                                <div class="text-danger mt-2" id="startDateErr"></div>
                                            </div>
                                            <div>
                                                <label for="dateEnd">Date End</label>
                                                <input
                                                    id="dateEnd"
                                                    v-model="paramsTask.date_end"
                                                    type="datetime-local"
                                                    class="form-input"
                                                    placeholder="Event End Date"
                                                />
                                                <div class="text-danger mt-2" id="endDateErr"></div>
                                            </div>
                                        </div>

                                        <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-outline-danger" @click="isAddTaskModal = false">Cancel</button>
                                            <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">{{ paramsTask.id ? 'Update' : 'Add' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- delete task modal -->
        <TransitionRoot appear :show="isDeleteModal" as="template">
            <Dialog as="div" @close="isDeleteModal = false" class="relative z-[51]">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay class="fixed inset-0 bg-[black]/60" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center px-4 py-8">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg text-black dark:text-white-dark">
                                <button
                                    type="button"
                                    class="absolute top-4 ltr:right-4 rtl:left-4 text-gray-400 hover:text-gray-800 dark:hover:text-gray-600 outline-none"
                                    @click="isDeleteModal = false"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="w-6 h-6"
                                    >
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <div class="text-lg font-medium bg-[#fbfbfb] dark:bg-[#121c2c] ltr:pl-5 rtl:pr-5 py-3 ltr:pr-[50px] rtl:pl-[50px]">
                                    Delete Task
                                </div>
                                <div class="p-5 text-center">
                                    <div class="text-white bg-danger ring-4 ring-danger/30 p-4 rounded-full w-fit mx-auto">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                            <path
                                                opacity="0.5"
                                                d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            ></path>
                                            <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path
                                                d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                            ></path>
                                            <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        </svg>
                                    </div>
                                    <div class="text-base sm:w-3/4 mx-auto mt-5">Are you sure you want to delete Task?</div>

                                    <div class="flex justify-center items-center mt-8">
                                        <button type="button" class="btn btn-outline-danger" @click="isDeleteModal = false">Cancel</button>
                                        <button type="button" class="btn btn-primary ltr:ml-4 rtl:mr-4" @click="deleteTask()">Delete</button>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>
<script lang="ts" setup>
    import { onMounted, ref } from 'vue';
    import { TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogOverlay } from '@headlessui/vue';
    import { VueDraggableNext as draggable } from 'vue-draggable-next';
    import Swal from 'sweetalert2';
    import { useAppStore } from '@/stores/index';
    import { useMeta } from '@/composables/use-meta';
    import axios from 'axios';
    useMeta({ title: 'Scrumboard' });
    const store = useAppStore();
    const params = ref({
        id: null,
        title: '',
    });
    const paramsTask = ref({
        project_id: null,
        user_id: null,
        user_name: '',
        id: null,
        title: '',
        description: '',
        tags: '',
        date_start: null,
        date_end: null,
    });
    const selectedTask: any = ref(null);
    const isAddProjectModal = ref(false);
    const isAddTaskModal = ref(false);
    const isDeleteModal = ref(false);
    const projectList: any = ref([]);
    const userList: any = ref([]);
    const isShowListUser = ref(false);

    const getProjectList = async () => {
        try {
            const projects: any = await axios.get(`http://127.0.0.1:8000/api/scrumboard/project/list`);
            projectList.value = [...projects?.data?.data];
            projectList.value = projectList.value.map(project => {
                return {
                    ...project,
                    tasks: project.tasks?.map(task => {
                        return {
                            project_id: project.id,
                            user_id: task.user_id,
                            user_name: userList?.value?.find((user: any) => user.id == task.user_id)?.name,
                            id: task.id,
                            title: task.title,
                            description: task.description,
                            date_start: task.date_start,
                            date_end: task.date_end,
                            tags: task.tags?.length > 0 ? task.tags.split(',') : [],
                        }
                    })
                }
            });
        } catch (error) {
            if (axios.isAxiosError(error)) {
                return error?.response?.data;
            }
            console.log('An error occurred:', error);
        }
    }

    const getUserList = async () => {
        try {
            const users: any = await axios.get(`http://127.0.0.1:8000/api/list-user`);
            userList.value = [...users?.data?.data];
            userList.value = userList.value.map(user => ({
                id: user.id,
                name: user.name,
                email: user.email,
            }));
        } catch (error) {
            if (axios.isAxiosError(error)) {
                return error?.response?.data;
            }
            console.log('An error occurred:', error);
        }
    }

    onMounted(async () => {
        await getUserList();
        await getProjectList();
        console.log(projectList.value);
    });

    const onDraggableChange = async (projectId, event: any) => {
        if (event.added) {
            const dragedItem = { ...event.added.element };

            if (dragedItem.project_id != projectId) {
                dragedItem.project_id = projectId;
                dragedItem.tags = dragedItem.tags.join(', ');

                try {
                    console.log('ondrag');
                    await axios.put(`http://127.0.0.1:8000/api/scrumboard/task/update/${dragedItem.id}`, dragedItem);
                } catch (error) {
                    if (axios.isAxiosError(error)) {
                        return error?.response?.data;
                    }
    
                    console.log('An error occurred:', error);
                }
            }
        }
    }

    const addEditProject = (project: any = null) => {
        setTimeout(() => {
            params.value = {
                id: null,
                title: '',
            };
            if (project) {
                params.value = JSON.parse(JSON.stringify(project));
            }

            isAddProjectModal.value = true;
        });
    };

    const saveProject = async () => {
        if (!params.value.title) {
            showMessage('Title is required.', 'error');
            return false;
        }

        if (params.value.id) {
            //update project
            const project = {
                id: params.value.id,
                title: params.value.title,
            };

            try {
                await axios.put(`http://127.0.0.1:8000/api/scrumboard/project/update/${project.id}`, project);

                await getProjectList();
            } catch (error) {
                if (axios.isAxiosError(error)) {
                    return error?.response?.data;
                }

                console.log('An error occurred:', error);
            }
        } else {
            //add project
            const project = {
                title: params.value.title,
            }

            try {
                await axios.post('http://127.0.0.1:8000/api/scrumboard/project/create', project);

                await getProjectList();
            } catch (error) {
                if (axios.isAxiosError(error)) {
                    return error?.response?.data;
                }

                console.log('An error occurred:', error);
            }
        }

        showMessage('Project has been saved successfully.');
        isAddProjectModal.value = false;
    };

    const deleteProject = async (project: any) => {
        try {
            const response = await axios.delete(`http://127.0.0.1:8000/api/scrumboard/project/delete/${project.id}`);

            if (response.status === 200) {
                showMessage('Project has been deleted successfully.');
    
                await getProjectList();
            }
        } catch (error) {
            if (axios.isAxiosError(error)) {
                return error?.response?.data;
            }

            console.log('An error occurred:', error);
        }
    };

    const clearProjects = async (project: any) => {
        try {
            await axios.delete(`http://127.0.0.1:8000/api/scrumboard/task/project-${project.id}/clear-all`);

            await getProjectList();
        } catch (error) {
            if (axios.isAxiosError(error)) {
                return error?.response?.data;
            }

            console.log('An error occurred:', error);
        }
    };

    // task
    const addEditTask = (projectId: any, task: any = null) => {
        paramsTask.value = {
            project_id: null,
            user_id: null,
            user_name: '',
            id: null,
            title: '',
            description: '',
            tags: '',
            date_start: null,
            date_end: null,
        };
        if (task) {
            paramsTask.value = JSON.parse(JSON.stringify(task));
            paramsTask.value.tags = paramsTask.value.tags ? paramsTask.value.tags.toString() : '';
        }
        paramsTask.value.project_id = projectId;
        isAddTaskModal.value = true;
    };

    const saveTask = async () => {
        if (!paramsTask.value.title) {
            showMessage('Title is required.', 'error');
            return false;
        }

        if (paramsTask.value.date_start && paramsTask.value.date_end) {
            const dateStartObj = new Date(paramsTask.value.date_start);
            const dateEndObj = new Date(paramsTask.value.date_end);

            if (dateStartObj > dateEndObj) {
                showMessage('Date end must be later than date start.', 'error');
                return false;
            }
        }

        if (paramsTask.value.id) {
            //update task
            const { user_name, ...task} = paramsTask.value;
            try {
                await axios.put(`http://127.0.0.1:8000/api/scrumboard/task/update/${task.id}`, task);

                await getProjectList();
            } catch (error) {
                if (axios.isAxiosError(error)) {
                    return error?.response?.data;
                }

                console.log('An error occurred:', error);
            }
        } else {
            //add task
            const { user_name, ...task} = paramsTask.value;
            try {
                await axios.post('http://127.0.0.1:8000/api/scrumboard/task/create', paramsTask.value);

                await getProjectList();
            } catch (error) {
                if (axios.isAxiosError(error)) {
                    return error?.response?.data;
                }

                console.log('An error occurred:', error);
            }
        }

        showMessage('Task has been saved successfully.');
        isAddTaskModal.value = false;
    };

    const deleteConfirmModal = (projectId: any, task: any = null) => {
        selectedTask.value = task;
        setTimeout(() => {
            isDeleteModal.value = true;
        }, 10);
    };

    const deleteTask = async () => {
        try {
            const response = await axios.delete(`http://127.0.0.1:8000/api/scrumboard/task/delete/${selectedTask.value.id}`);

            if (response.status === 200) {
                showMessage('Task has been deleted successfully.');
                isDeleteModal.value = false;
    
                await getProjectList();
            }
        } catch (error) {
            if (axios.isAxiosError(error)) {
                return error?.response?.data;
            }

            console.log('An error occurred:', error);
        }
    };

    const classExpireTime = (dateEnd: any) => {
        const currDateObj = Date.now();
        const dateEndObj = new Date(dateEnd);

        return currDateObj < dateEndObj.getTime() ? 'text-success' : 'text-danger';
    }

    const handleBlur = () => {
        setTimeout(() => {
            isShowListUser.value = false;
        }, 200);
    }

    const handleAssignForUser = (user: any) => {
        paramsTask.value.user_id = user.id;
        paramsTask.value.user_name = user.name;
    }

    const formatDatetime = (date: any) => {
        if (date) {
            const dateObj = new Date(date);
            const dd = String(dateObj.getDate()).padStart(2, '0');
            const mm = String(dateObj.getMonth()) //January is 0!
            const yyyy = dateObj.getFullYear();
            const hh = String(dateObj.getHours()).padStart(2, '0');
            const ii = String(dateObj.getMinutes()).padStart(2, '0');
            const monthNames: any = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
            return `${hh}:${ii} - ${dd} ${monthNames[mm]}, ${yyyy}`;
        }

        return '';
    }

    const showMessage = (msg = '', type = 'success') => {
        const toast: any = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            customClass: { container: 'toast' },
        });
        toast.fire({
            icon: type,
            title: msg,
            padding: '10px 20px',
        });
    };
</script>
