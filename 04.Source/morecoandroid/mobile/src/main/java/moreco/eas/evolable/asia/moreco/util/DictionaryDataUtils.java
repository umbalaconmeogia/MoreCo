package moreco.eas.evolable.asia.moreco.util;

import com.google.gson.JsonElement;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.google.gson.JsonSyntaxException;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */

public class DictionaryDataUtils {

    public static final String REQUEST_DICTIONARY_VERSION_URL = "http://morecoweb.chauhai.com//index.php?r=dict-api/version";
    public static final String REQUEST_DICTIONARY_DATA_URL = "http://morecoweb.chauhai.com//index.php?r=dict-api/data&maxDictSentenceNumber=10";

    public DictionaryDataUtils() {
    }

    public JsonObject requestDictionaryJsonObject (String requestUrlString) {
        StringBuilder result = new StringBuilder();
        try {
            URL url = new URL(requestUrlString);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            InputStream stream;
            if (conn.getResponseCode() == 200) //success
            {
                stream = conn.getInputStream();
            } else
                stream = conn.getErrorStream();

            BufferedReader reader = new BufferedReader(new InputStreamReader(stream));
            String line;
            while ((line = reader.readLine()) != null) {
                result.append(line);
            }

            JsonParser parser = new JsonParser();

            JsonElement element = parser.parse(result.toString());

            if (element.isJsonObject()) {
                JsonObject obj = element.getAsJsonObject();
                if (obj.get("error") == null) {
//                    String version = obj.get("version").getAsString();
//                    int    versionId = obj.get("id").getAsInt();
//
//                    if (BuildConfig.DEBUG) Log.d("DictVersionUtil", "Version : " + version);
//                    if (BuildConfig.DEBUG) Log.d("DictVersionUtil","Version Id : " + versionId);
                    return obj;
                }
            }

            if (conn.getResponseCode() != 200) {
                System.err.println(result);
            }

        } catch (IOException | JsonSyntaxException ex) {
            System.err.println(ex.getMessage());
        }

        return null;
    }
}
