package com.example.shopper

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val login_btn = findViewById<Button>(R.id.login_btn)
        var email = findViewById<EditText>(R.id.email)
        var password = findViewById<EditText>(R.id.password)
        var register = findViewById<TextView>(R.id.register_txt)

        register.setOnClickListener {
            val intent = Intent(this, Sign_in::class.java)
            startActivity(intent)
        }


        login_btn.setOnClickListener {

            val mail:String = email.text.toString()
            val pass:String = password.text.toString()
            login(mail,pass)
        }
    }

    private fun login(mail: String, pass: String) {
        var url = "http://192.168.105.4/services/login.php"
        val rq: RequestQueue=Volley.newRequestQueue(this)
        val sr:StringRequest= object : StringRequest(Request.Method.POST,url,Response.Listener { response ->
            if(response.equals("Login Successfull")){
                Toast.makeText(this,"Welcome to Our App", Toast.LENGTH_LONG).show()
                val intent = Intent(this, Dashboard::class.java)
                startActivity(intent)
            }else{
                Toast.makeText(this,"Check your Email or Password", Toast.LENGTH_LONG).show()
            }
        },
            Response.ErrorListener { error ->
                Toast.makeText(this,error.message,Toast.LENGTH_LONG).show()
        }){
            override fun getParams(): MutableMap<String, String>? {
                val map = HashMap<String, String>()
                map.put("email", mail)
                map.put("password", pass)
                return map
            }
        }
        rq.add(sr)
    }
}


