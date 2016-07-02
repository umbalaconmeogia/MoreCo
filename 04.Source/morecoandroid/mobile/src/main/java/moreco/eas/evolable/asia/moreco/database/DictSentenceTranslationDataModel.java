package moreco.eas.evolable.asia.moreco.database;

import io.realm.RealmObject;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class DictSentenceTranslationDataModel extends RealmObject {
    private int id;
    private int dict_language_id;
    private int dict_sentence_id;
    private String translated_sentence;
    private String searching_text;
    private int data_status;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getDict_language_id() {
        return dict_language_id;
    }

    public void setDictlanguageid(int dict_language_id) {
        this.dict_language_id = dict_language_id;
    }

    public int getDict_sentence_id() {
        return dict_sentence_id;
    }

    public void setDictsentenceid(int dict_sentence_id) {
        this.dict_sentence_id = dict_sentence_id;
    }

    public String getTranslated_sentence() {
        return translated_sentence;
    }

    public void setTranslated_sentence(String translated_sentence) {
        this.translated_sentence = translated_sentence;
    }

    public String getSearching_text() {
        return searching_text;
    }

    public void setSearching_text(String searching_text) {
        this.searching_text = searching_text;
    }

    public int getData_status() {
        return data_status;
    }

    public void setData_status(int data_status) {
        this.data_status = data_status;
    }


}
