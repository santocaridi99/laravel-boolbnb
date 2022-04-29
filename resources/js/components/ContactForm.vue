<template>
  <div>
    <div class="title_back my-5 text-center fw-bold">
      <h1>
        Contatta l'host
        <h1 class="title_front mt-4">Contatta l'host</h1>
      </h1>
    </div>
    <div v-if="!formSubmitted" class="text-white">
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Nome</label>
        <input
          type="text"
          class="form-control"
          id="exampleFormControlInput2"
          placeholder="Mario"
          v-model="formData.name"
        />
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.name"
          >{{ formValidationErrors.name }}</span
        >
      </div>
      <p class="text-danger" v-if="!$v.formData.name.required">required</p>
      <p class="text-danger" v-if="!$v.formData.name.alpha">solo lettere</p>
      <p class="text-danger" v-if="!$v.formData.name.minLength">
        Minimo 2 lettere
      </p>
      <p class="text-danger" v-if="!$v.formData.name.maxLength">
        Massimo 20 lettere
      </p>

      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Cognome</label>
        <input
          type="text"
          class="form-control"
          id="exampleFormControlInput2"
          placeholder="Rossi"
          v-model="formData.lastname"
        />
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.lastname"
          >{{ formValidationErrors.lastname }}</span
        >
      </div>
      <p class="text-danger" v-if="!$v.formData.lastname.required">required</p>
      <p class="text-danger" v-if="!$v.formData.lastname.alpha">solo lettere</p>
      <p class="text-danger" v-if="!$v.formData.lastname.minLength">
        Minimo 2 lettere
      </p>
      <p class="text-danger" v-if="!$v.formData.lastname.maxLength">
        Massimo 20 lettere
      </p>

      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"
          >Indirizzo Email</label
        >
        <input
          type="email"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="name@example.com"
          v-model="formData.email"
        />
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.email"
          >{{ formValidationErrors.email }}</span
        >
      </div>
      <p class="text-danger" v-if="!$v.formData.email.required">required</p>
      <p class="text-danger" v-if="!$v.formData.email.email">
        inserisci un email corretta
      </p>

      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Messaggio</label
        >
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"
          v-model="formData.content"
        ></textarea>
        <span
          class="text-danger"
          v-if="formValidationErrors && formValidationErrors.content"
          >{{ formValidationErrors.content }}</span
        >
      </div>
      <p class="text-danger" v-if="!$v.formData.content.required">required</p>
      <p class="text-danger" v-if="!$v.formData.content.minLength">
        Minimo 2 lettere
      </p>
      <p class="text-danger" v-if="!$v.formData.content.maxLength">
        Massimo 250 lettere
      </p>
      <button
        type="submit"
        class="button_forward d-flex align-items-center px-4"
        @click="formSubmit"
      >
        Invia
        <img class="ps-2" src="/img/frecce.svg" alt="" />
      </button>
    </div>

    <div v-else class="alert alert-success py-5">
      <h4>Grazie per averci contattato.</h4>
      <p class="lead">
        La sua richiesta è stata inviata correttamente e risponderemo il prima
        possibile.
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {
  required,
  minLength,
  email,
  maxLength,
  alpha,
} from "vuelidate/lib/validators";
export default {
  props: ["apartment_id"],

  data() {
    return {
      formSubmitted: false,
      formData: {
        name: "",
        lastname: "",
        email: "",
        content: "",
        apartment_id: this.apartment_id,
      },
      user: null,
      formValidationErrors: null,
    };
  },
  validations: {
    formData: {
      name: {
        required,
        alpha,
        minLength: minLength(2),
        maxLength: maxLength(20),
      },
      lastname: {
        required,
        alpha,
        minLength: minLength(2),
        maxLength: maxLength(50),
      },
      email: {
        required,
        email,
      },
      content: {
        required,
        minLength: minLength(2),
        maxLength: maxLength(250),
      },
    },
  },
  methods: {
    async formSubmit() {
      /* alert(this.apartment_id); */
      try {
        this.formValidationErrors = null;
        const formDataInstance = new FormData();
        formDataInstance.append("name", this.formData.name);
        formDataInstance.append("lastname", this.formData.lastname);
        formDataInstance.append("email", this.formData.email);
        formDataInstance.append("content", this.formData.content);
        formDataInstance.append("apartment_id", this.formData.apartment_id);

        const resp = await axios.post("/api/messages", formDataInstance);
        // resp.data;
        this.formSubmitted = true;
      } catch (er) {
        // 422 = errore di validazione
        if (er.response.status === 422) {
          this.formValidationErrors = er.response.data.errors;
        }
        alert(
          "A causa di un errore non è stato possibile inviare la sua richiesta.\n\n" +
            er.response.data.message
        );
      }
    },

    isUserLogged() {
      if (this.user.name != null) {
        this.formData.name = this.user.name;
        this.formData.lastname = this.user.lastname;
        this.formData.email = this.user.email;
      }
    },

    fetchUser() {
      // recuperiamo l'utente loggato tramite api
      axios
        .get("/api/user")
        .then((resp) => {
          // Nel caso in cui sia loggato, riceviamo i dettagli dell'utente
          // li salviamo in una variabile locale.
          this.user = resp.data;
          console.log(this.user);
          // All'interno del localStorage, salviamo i dettagli dell'utente
          localStorage.setItem("user", JSON.stringify(resp.data));
          // Per comunicare in tempo reale che l'utente loggato è cambiato,
          // lanciamo un evento custom su window
          window.dispatchEvent(new CustomEvent("storedUserChanged"));
          if (this.user !== null) {
            this.formData.name = this.user.name;
            this.formData.email = this.user.email;
            console.log(this.formData.name);
          }
        })
        .catch((er) => {
          // Entriamo nel catch SOLO se l'utente non è loggato e il server ci ritorna
          // un codice diverso da 200. Se non siamo loggati abbiamo un 401.
          // Nel caso di errore, cancelliamo i dettagli dell'utente dal localStorage
          localStorage.removeItem("user");
          // Per comunicare in tempo reale che l'utente loggato è cambiato,
          // lanciamo un evento custom su window
          window.dispatchEvent(new CustomEvent("storedUserChanged"));
        });
    },
    getStoredUser() {
      const storedUser = localStorage.getItem("user");
      if (storedUser) {
        this.user = JSON.parse(storedUser);
      } else {
        this.user = null;
      }
    },
  },
  mounted() {
    this.fetchUser();
  },
};
</script>

<style lang="scss" scoped>
.title_back {
  max-width: 680px;
  margin: 0 auto;
  h1 {
    position: relative;
    font-size: 80px;
    font-weight: 700;
    .title_front {
      font-size: 38px;
      font-weight: 500;
      padding-left: 60px;
      position: absolute;
      top: 20px;
      color: #fff;
    }
  }
}
</style>
