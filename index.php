<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue" type="text/javascript"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>

    <link rel="stylesheet" href="/css/vmodal.css">

</head>
<body>

<div class="container" id="app">

    <div class="row">
        <div class="col-12">&nbsp;</div>
    </div>

    <modal v-if="addModal" @close="addModal = false">

        <form @submit.prevent="appends()">

            <div class="form-group">
                <label for="fullname">Полное имя ({{ fullname.length }} > 10) :</label>
                <input type="text" class="form-control" name="fullname" v-model="fullname">
            </div>

            <div class="form-group">
                <label for="phone">Телефон ({{ phone.length }} = 17) :</label>
                <input type="text" class="form-control" name="phone" v-model="phone" placeholder="8 (800) 555 35-35">
            </div>
            <div class="form-group">
                <label for="bankof">Банк ({{ bankof.length }} > 2):</label>
                <input type="text" class="form-control" name="bankof" v-model="bankof">
            </div>

            <input type="submit" value="Отправить" class="btn btn-primary" v-if="fullname.length > 9 && phone.length == 17 && bankof.length > 2">

        </form>

    </modal>
    <modal v-if="editModal" @close="editModal = false">

        <form @submit.prevent="sendEdit()">

            <div class="form-group">
                <label for="fullname">Полное имя ({{ editFullname }} > 10 ):</label>
                <input type="text" class="form-control" name="fullname" v-model="editFullname">
            </div>

            <div class="form-group">
                <label for="phone">Телефон ({{ editPhone }} = 17):</label>
                <input type="text" class="form-control" name="phone" v-model="editPhone" placeholder="8 (800) 555 35-35">
            </div>
            <div class="form-group">
                <label for="bankof">Банк ({{ editBankof }} > 2):</label>
                <input type="text" class="form-control" name="bankof" v-model="editBankof">
            </div>

            <input type="submit" value="Отправить" class="btn btn-primary" v-if="editFullname.length > 9 && editPhone.length == 17 && editBankof.length > 2">


        </form>

    </modal>

    <div class="row">
        <div class="col-12">

            <button class="btn btn-info" id="show-modal" @click="addModal = true" v-if="addModal == false">Добавить</button>
            <button class="btn btn-primary" @click="autoComp()">Автозаполнение</button>

            <hr>

            <table class="table table-bordered" v-if="rows.length > 0">

                  <thead>

                     <th title="идентификатор">ID</th>
                     <th title="Полное имя">Полное имя</th>
                     <th title="Телефонный номер">Телефон</th>
                     <th title="Банк">Банк</th>
                     <th width="25px" title="Редактировать"><img src="https://cdn0.iconfinder.com/data/icons/glyphpack/45/edit-alt-512.png" width="25" height="25" alt=""></th>
                     <th width="25px" title="Удалить"><img src="https://icon-library.com/images/icon-delete/icon-delete-16.jpg" width="25" height="25" alt=""></th>

                  </thead>

                  <tbody>

                     <tr v-for="i in rows">

                       <td width="30">{{ i.id }}</td>
                       <td>{{ i.fullname }}</td>
                       <td>{{ i.phone }}</td>
                       <td>{{ i.bankof }}</td>
                       <td><img style="cursor:pointer;" @click="edits(i)" src="https://cdn0.iconfinder.com/data/icons/glyphpack/45/edit-alt-512.png" width="25" height="25" alt=""></td>
                       <td><img style="cursor: pointer" @click="delets(i.id)" src="https://icon-library.com/images/icon-delete/icon-delete-16.jpg" width="25" height="25" alt=""></td>

                     </tr>

                  </tbody>

            </table>

        </div>
    </div>

</div>

<template id="modal-template">

    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-default-button" @click="$emit('close')">X</div>

                    <slot></slot>

                </div>
            </div>
        </div>
    </transition>

</template>


<script type="text/javascript">

    new Vue({
        el:'#app',
        data:{
            fullname:"",
            editFullname:"",
            phone:'',
            editPhone:'',
            bankof:'',
            editBankof:'',
            addModal: false,
            editModal: false,
            editId:'',
            rows:[]
        },
        methods:{
            appends(){ // Функция добавлкения новой запсиси в базу данных

                let myDataObj = {fullname:this.fullname, phone:this.phone, bankof:this.bankof}
                let formData = new FormData();

                for (var key in myDataObj) {
                    formData.append(key, myDataObj[key])
                }

                axios.post('/insert.php', formData, {}).then(data => this.rows = data.data)

                this.fullname = "";
                this.phone = "";
                this.bankof = "";
                this.addModal = false;
            },
            edits(val){ // Функиция открытия диалогового окна и установка дефолтныйх значений
                this.editModal = true;

                this.editId = val.id;
                this.editFullname = val.fullname;
                this.editPhone = val.phone;
                this.editBankof = val.bankof;
            },
            sendEdit(){ // Функция обновления записи

                let myDataObj = {id:this.editId,editfullname:this.editFullname,editphone:this.editPhone,editbankof:this.editBankof}
                let formData = new FormData();

                for (var key in myDataObj) {
                    formData.append(key, myDataObj[key])
                }

                axios.post('/update.php', formData, {}).then(data => this.rows = data.data);

                this.editId = '';
                this.editFullname = '';
                this.editPhone = '';
                this.editBankof = '';

                this.editModal = false;

            },
            delets(val){ // Функция удаления записи

                let myDataObj = {id:val}
                let formData = new FormData();

                for (var key in myDataObj) {
                    formData.append(key, myDataObj[key])
                }

                axios.post('/delete.php', formData, {}).then(data => this.rows = data.data);
            },
            autoComp(){ // Функция автозаполнения пустого списка
                axios.post('/auto.php').then(data => this.rows = data.data);
            }
        },
        components:{
            modal:{
                template:"#modal-template"
            }
        },
        beforeMount(){ // Функция добавления записей при загрузке страницы
            axios.post('/gets.php').then(data => this.rows = data.data)
        }
    });

</script>

</body>
</html>
