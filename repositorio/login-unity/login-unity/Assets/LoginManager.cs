using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class LoginManager : MonoBehaviour {

	[SerializeField]
	private InputField nomeField = null;
	[SerializeField]
	private InputField usuarioField = null;
	[SerializeField]
	private InputField senhaField = null;
	[SerializeField]
	private Text feedbackmsg = null;
	[SerializeField]
	private Toggle rememberData = null;
	[SerializeField]
	private Toggle concordaTermo = null;

	private string url = "https://www.holodroide.com/espec_bares/login.php";
	private string urlCad = "https://www.holodroide.com/espec_bares/add-esp.php";

	// Use this for initialization
	void Start () {
		if (PlayerPrefs.HasKey ("remember") && PlayerPrefs.GetInt ("remember") == 1) {
			//nomeField.text = PlayerPrefs.GetString ("rememberName");
			usuarioField.text = PlayerPrefs.GetString ("rememberLogin");
			senhaField.text = PlayerPrefs.GetString ("rememberPass");
			//Linha abaixo envia a cena de RA automaticamente para que já está cadastrado
			StartCoroutine (CarregaScene ());
		}
	}

// ################ Rootina botão LOGIN ###################
	public void FazerLogin () {
		if (usuarioField.text == "" || senhaField.text == "") {
			FeedBackError ("Preencha todos os campos!");

		} else {
			
			//string nome = nomeField.text;
			string usuario = usuarioField.text;
			string senha = senhaField.text;

			if (rememberData.isOn) {
				PlayerPrefs.SetInt ("remember", 1);
				//PlayerPrefs.SetString ("rememberName", nome);
				PlayerPrefs.SetString ("rememberLogin", usuario);
				PlayerPrefs.SetString ("rememberPass", senha);
			}

			// ################ Atribui valor a campos de formulário para enviar como POST ###########
			WWWForm form = new WWWForm ();
			form.AddField ("login", usuario);
			form.AddField ("senha", senha);

			// ################ Envia para servidor os campos de formulários definidos acima ###########
			WWW www = new WWW (url, form);
			StartCoroutine (ValidaLogin (www));
		}

	}

	IEnumerator ValidaLogin(WWW www){
		yield return www;
		if (www.error == null) {
			if (www.text == "1") {
				FeedBackOk ("Login realizado com sucesso\nCarregando HOLODROIDE!");
				StartCoroutine (CarregaScene ());
			} else {
				FeedBackError ("Usuário ou Senha inválidos!\nTente outra vez...");
			}
				
		}else{
			if(www.error == "couldnt connect to host"){
				FeedBackError("Servidor indisponivel");
			}
		}
	}

	// ################ Rootina botão CADASTRAR ###################
	public void FazerCadastro () {
		
		if (nomeField.text == "" || usuarioField.text == "" || senhaField.text == "") {

			FeedBackError ("Preencha todos os campos!");

			} else {

			string nome = nomeField.text;
			string usuario = usuarioField.text;
			string senha = senhaField.text;		

			//PlayerPrefs.SetInt ("remember", 1);
			//PlayerPrefs.SetString ("rememberName", nome);
			//PlayerPrefs.SetString ("rememberLogin", usuario);
			//PlayerPrefs.SetString ("rememberPass", senha);	


				if (concordaTermo.isOn) {

					// ################ Atribui valor a campos de formulário para enviar como POST ###########
					WWWForm form = new WWWForm ();
					form.AddField ("nome", nome);
					form.AddField ("email", usuario);
					form.AddField ("senha", senha);

					// ################ Envia para servidor os campos de formulários definidos acima ###########
					WWW www = new WWW (urlCad, form);
					StartCoroutine (ValidaCadastro (www));

				}else{

					FeedBackError ("Você precisa aceitar os Termos de Uso!");

			}

		}
			
	}

	IEnumerator ValidaCadastro(WWW www){
		yield return www;
		if (www.error == null) {
			if (www.text == "1") {
				FeedBackOk ("Cadastro realizado com sucesso\nCarregando HOLODROIDE!");
				StartCoroutine (CarregaScene ());
			} else {
				FeedBackError ("Email já cadastrado!\nTente outra vez...");
			}

		}else{
			if(www.error == "couldn't connect to host"){
				FeedBackError("Servidor indisponivel");
			}
		}
	}



	// ################ Rootina botão LOGOUT ###################
	public void FazerLogout () {

		string usuario = "";
		string senha = "";

		PlayerPrefs.SetInt ("remember", 0);
		PlayerPrefs.SetString ("rememberLogin", usuario);
		PlayerPrefs.SetString ("rememberPass", senha);

		StartCoroutine (CarregaVoltar ());
	}






	// ################ Redireciona para carregar o aplicativo ###########
	IEnumerator CarregaScene() {
		yield return new WaitForSeconds (0);
		Application.LoadLevel ("holodroide");
	}

// ################ Rootina botão CADASTRAR ###################
	public void Registro (){
		StartCoroutine (CarregaCadastro ());
	
	}

	IEnumerator CarregaCadastro() {
		yield return new WaitForSeconds (0);
		Application.LoadLevel ("registro");
	}
// #########################################################

// ################ Rootina botão VOLTAR ###################
	public void Voltar (){
		StartCoroutine (CarregaVoltar ());

	}

	IEnumerator CarregaVoltar() {
		yield return new WaitForSeconds (0);
		Application.LoadLevel ("login");
	}
// #########################################################

// ################ Rootina botão VOLTAR ###################
	public void Termos (){
		StartCoroutine (CarregaTermos ());

	}

	IEnumerator CarregaTermos() {
		yield return new WaitForSeconds (0);
		Application.LoadLevel ("termos");
	}
// #########################################################



	// ################ Mensagens de Feedback ###########
	void FeedBackOk (string mensagem){
		feedbackmsg.CrossFadeAlpha (100f, 1f, false);
		feedbackmsg.color = Color.green;
		feedbackmsg.text = mensagem;
	}
	void FeedBackError (string mensagem){
		feedbackmsg.CrossFadeAlpha (100f, 1f, false);
		feedbackmsg.color = Color.yellow;
		feedbackmsg.text = mensagem;
		usuarioField.text = "";
		senhaField.text = "";
	}

}
