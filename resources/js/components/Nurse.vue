<template>
 <div class="col-lg-12">
    <div class="chat">
      <div class="chat-title">
        <div class="row">
          <img class="rounded-circle" :src="`/uploads/nurse/${userauth.image}`" width="90">
          <div class="col-6 mt-auto mb-auto ml-3">{{userauth.name}}</div>
        </div>
      </div>
        <div class="list-messages" v-if="messages.messages && messages.messages.length > 0">
          <div v-for="m in messages.messages" :key="m.id">
            <!-- <span style="color:blue;">
              <strong></strong> :
            </span> -->
            <div class = "messages" >
              <div class="message">
                <div class="messages-content"></div>
                <div class="message message-personal">
                  <div class=""> 
                    {{nurse.id == m.user_id ? nurse.name : patient.name}}
                  </div>
                  {{m.body}}
                </div>
              </div>
                <img v-if="messages.messages.image" :src="`/uploads/${messages.image}`" class="img-thumbnail"/>
            </div>
          
          </div>
        </div>
        <div class="messages-not-found" v-else>Messages not found</div>
      
          <div class="message-box">
            <form @submit.prevent="sendNurseMessage()">
              <input id="chat_id" type="hidden" name="chat_id"  :value="chat_id">
              <input id="user_id" type="hidden" name="user_id"  :value="IsNurse()">
              <div class="row col-lg-12">
                <div class="col-lg-1 mt-3 text-center file-upload">
                  <input type="file" name="image" id="image" ref="myFileInput"  />
                  <i class="fa fa-paperclip"></i>
                </div>
                <input type="text" class="col-lg-9 form-control message-input" v-model="messageInput" placeholder="type your chat" name="body" />
                <button type="submit" class="col-lg-1 mt-3 message-submit">Send</button>
              </div>
            </form>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [],
      message: "", 
      messageInput:"",
      patient_id:this.patient.id,
      chat_id:this.chat.id
    };
    
  },
  props:['patient','nurse','userauth','chat'],
  sockets: {
    connect: function () {
      console.log("Socket Connected");
    },
    message: function (val) {
      this.getNurseMessages();
       console.log('done');
    },
  },
  methods: {
    async sendNurseMessage() {
       this.messageInput = '';
      console.log(event.target);
      let form = new FormData(event.target);
      // form.append("chat_id", this.chat_id);
      form.append("patient_name", this.patient.firstName);
      form.append("nurse_name", this.nurse.name);
	   this.$refs.myFileInput.value = '';
      try {
        await axios.post("http://127.0.0.1:8000/Nurse/sendMessage", form);
        event.target.reset();
      } catch (error) {console.log(error)}
    },
    getNurseMessages() {
      axios.get("http://127.0.0.1:8000/chat/nurse/"+ this.chat_id +"/messages").then((response) => {
        console.log(response);
        this.messages = response.data;
      });
    },
    IsNurse(){
       if(this.userauth.id == this.nurse.id)
       return this.nurse.id;
       else
       return this.patient.id;
     },
     
  },
  mounted() {
    this.getNurseMessages();

  },
};
</script>
