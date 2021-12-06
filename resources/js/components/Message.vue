<template>
 <div class="col-lg-12">
    <div class="chat">
      <div class="chat-title">{{userauth.name}}</div>
        <div class="list-messages" v-if="messages.messages && messages.messages.length > 0">
          <p id = "chat_id" style="display:none;">{{messages.id}}</p>
          <div v-for="m in messages.messages" :key="m.id">
            <!-- <span style="color:blue;">
              <strong></strong> :
            </span> -->
            <div class = "messages" >
              <div class="message">
                <div class="messages-content"></div>
                <div class="message message-personal">
                  <div class=""> 
                    {{doctor.id == m.user_id ? 'Dr ' + doctor.name : patient.firstName}}
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
            <form @submit.prevent="sendMesaage()">
              <input id="chat_id" type="hidden" name="chat_id"  :value="chat_id">
              <input id="user_id" type="hidden" name="user_id"  :value="IsDoctor()">
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
  props:['patient','doctor','userauth','chat'],
  sockets: {
    connect: function () {
      console.log("Socket Connected");
    },
    message: function (val) {
      this.getMessage();
       console.log('done');
    },
  },
  methods: {
    async sendMesaage() {
       this.messageInput = '';
      console.log(event.target);
      let form = new FormData(event.target);
      // form.append("chat_id", this.chat_id);
      form.append("patient_name", this.patient.firstName);
      form.append("doctor_name", this.doctor.name);
      
	   this.$refs.myFileInput.value = '';
      try {
        await axios.post("https://phistory.life/Phistory/sendMessage", form);
        event.target.reset();
      } catch (error) {console.log(error)}
    },
    getMessage() {
      axios.get("https://phistory.life/Phistory/chat/" + this.chat_id+ "/messages").then((response) => {
        console.log(this.messages.id);
        this.messages = response.data;
      });
    },
    IsDoctor(){
       if(this.userauth.id == this.doctor.id)
       return this.doctor.id;
       else
       return this.patient.id;
     },
   
    
     
  },
  mounted() {
    this.getMessage();
  },
};
</script>
